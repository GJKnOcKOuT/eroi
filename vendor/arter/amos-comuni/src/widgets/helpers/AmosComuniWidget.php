<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\comuni\widgets\helpers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comuni\widgets\helpers;

use arter\amos\comuni\assets\ComuniAsset;
use arter\amos\core\record\Record;
use yii\base\Exception;
use yii\base\Widget;

/**
 * Class AmosComuniWidget
 *
 * <p><b>Widget che permette la creazione delle tendine dei dati residenziali: Nazione, Provincia, Comune, Cap</b></p>
 *
 * Ogni tendina è configurabile con le configurazioni previste dai widget usato:
 * - Nazione => Select2
 * - Provincia => Select2
 * - Comune => DepDrop
 * - CAP => DepDrop
 *
 * campo fondamentale 'attribute' dove indicare il nome del field del model da utilizzare
 *
 * <p>esempio di configurazione base</p>
 *
 * ```php
 * echo \arter\amos\comuni\widgets\helpers\AmosComuniWidget::widget([
 *   'form' => $form,
 *   'model' => $model,
 *   'nazioneConfig' => [
 *       'attribute' => 'nazione_id',
 *   ],
 *   'provinciaConfig' => [
 *       'attribute' => 'istat_province_id',
 *   ],
 *   'comuneConfig' => [
 *       'attribute' => 'istat_comuni_id',
 *   ],
 *   'capConfig' => [
 *       'attribute' => 'cap_id',
 *   ]
 *   ]);
 * ```
 * @package arter\amos\comuni\widgets\helpers
 */
class AmosComuniWidget extends Widget
{
    public $form;
    public $model;
    public $nazioneConfig;
    public $provinciaConfig;
    public $comuneConfig;
    public $capConfig;
    protected $params;
    public $elementByRow = 4;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        //controllo esistenza attributo form
        if (!isset($this->form)) {
            throw new Exception(\Yii::t('app', 'Undefined Form object'));
        }
        //controllo esistenza attributo model
        if (!isset($this->model)) {
            throw new Exception(\Yii::t('app', 'Undefined Model object'));
        }

        //se presente Provincia è richiesto anche Comune: se presente provincia ma non comune lancio errore
        if (isset($this->provinciaConfig) && !isset($this->comuneConfig)) {
            throw new Exception(\Yii::t('app', 'Provincia e Comune must both be declared'));
        }

        //Cap necessita di Comune
        if ((isset($this->capConfig) && !isset($this->comuneConfig))) {
            throw new Exception(\Yii::t('app', 'Comune must be declared for Cap usage'));
        }

        $this->params = [
            'model' => $this->model,
            'form' => $this->form,
            'nazioneConfig' => $this->nazioneConfig,
            'provinciaConfig' => $this->provinciaConfig,
            'comuneConfig' => $this->comuneConfig,
            'capConfig' => $this->capConfig,
            'colMdRow' => 3
        ];
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        //registro il file comuni_common_js.js a tutte le varie view
        ComuniAsset::register(\Yii::$app->getView());

        $html_nazione = '';
        $html_provincia = '';
        $html_comune = '';
        $html_cap = '';

        $dimensions = $this->getCalculatedElementByRow();
        $this->params['widget'] = $this;

        if (isset($this->nazioneConfig)) {
            $this->params['colMdRow'] = array_shift($dimensions);
            $html_nazione = $this->render('nazione_view', $this->params);
        }
        if (isset($this->provinciaConfig)) {
            $this->params['colMdRow'] = array_shift($dimensions);
            $html_provincia = $this->render('provincia_view', $this->params);
            $this->params['colMdRow'] = array_shift($dimensions);
            $html_comune = $this->render('comune_view', $this->params);
        } else {
            $this->params['colMdRow'] = array_shift($dimensions);
            $html_comune = $this->render('comune_single_select_view', $this->params);
        }

        if (isset($this->capConfig)) {
            $this->params['colMdRow'] = array_shift($dimensions);
            $html_cap = $this->render('cap_view', $this->params);
        }

        $html_complete = $html_nazione . $html_provincia . $html_comune . $html_cap;

        return $html_complete;
    }

    /**
     * @param Record $model
     * @param string $fieldName
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function generateFieldId($model, $fieldName)
    {
        return $model->formName() . '-' . $fieldName . '-id';
    }

    /**
     * @return array
     */
    public function getCalculatedElementByRow()
    {
        $nElem = 1;
        $divColMd = null;
        $dimensions = [];
        if (!empty($this->nazioneConfig)) {
            $nElem++;
        }
        if (!empty($this->provinciaConfig)) {
            $nElem++;
        }
        if (!empty($this->capConfig)) {
            $nElem++;
        }
        $resto = $nElem % $this->elementByRow;
        if ($resto = $nElem || $resto == 0) {
            $div1 = bcdiv(12, $nElem);
            for ($n = $nElem; $n > 0; $n--) {
                $dimensions[] = $div1;
            }
        } else {
            $completo = $nElem - $resto;
            $div2 = bcdiv(12, $completo);
            $div3 = bcdiv(12, $resto);
            for ($b = $completo; $b > 0; $b--) {
                $dimensions[] = $div2;
            }
            for ($c = $resto; $c > 0; $c--) {
                $dimensions[] = $div3;
            }
        }
        return $dimensions;
    }
}
