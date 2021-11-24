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
 * @package    arter\amos\documenti\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\core\widget\WidgetAbstract;
use arter\amos\core\icons\AmosIcons;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\Documenti;
use arter\amos\documenti\models\search\DocumentiSearch;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconAdminAllDocumenti
 * @package arter\amos\documenti\widgets\icons
 */
class WidgetIconAdminAllDocumenti extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $paramsClassSpan = [
            'bk-backgroundIcon',
        ];

        $this->setLabel(AmosDocumenti::tHtml('amosdocumenti', '#documenti_widget_label_all_admin'));
        $this->setDescription(AmosDocumenti::t('amosdocumenti', '#documenti_widget_description_all_admin'));
        $this->setIcon('file-text-o');
        $this->setUrl(['/documenti/documenti/admin-all-documents']);
        $this->setCode('ADMIN-ALL-DOCUMENTI');
        $this->setModuleName('documenti');
        $this->setNamespace(__CLASS__);

        if (!empty(Yii::$app->params['dashboardEngine']) && Yii::$app->params['dashboardEngine'] == WidgetAbstract::ENGINE_ROWS) {
            $paramsClassSpan = [];
        }

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                $paramsClassSpan
            )
        );

//        if ($this->disableBulletCounters == false) {
//            /** @var DocumentiSearch $search */
//            $search = AmosDocumenti::instance()->createModel('DocumentiSearch');
//            $this->setBulletCount(
//                $this->makeBulletCounter(
//                    Yii::$app->getUser()->getId(),
//                    Documenti::className(),
//                    $search->buildQuery([], 'admin-all')
//                )
//            );
//        }
    }

    /**
     * Aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
     * 
     * @inheritdoc
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
                parent::getOptions(),
                ['children' => []]
        );
    }

}
