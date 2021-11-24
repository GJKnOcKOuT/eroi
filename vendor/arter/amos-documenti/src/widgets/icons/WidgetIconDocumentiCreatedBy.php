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

use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\Documenti;
use arter\amos\documenti\models\search\DocumentiSearch;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconDocumentiCreatedBy
 * @package arter\amos\documenti\widgets\icons
 */
class WidgetIconDocumentiCreatedBy extends WidgetIcon
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

        $this->setLabel(AmosDocumenti::tHtml('amosdocumenti', '#documenti_widget_label_created_by'));
        $this->setDescription(AmosDocumenti::t('amosdocumenti', '#documenti_widget_description_created_by'));
        $this->setIcon('file-text-o');
        $this->setUrl(['/documenti/documenti/own-documents']);
        $this->setCode('DOCUMENTI_CREATEDBY');
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

//        /** @var DocumentiSearch $search */
//        $search = AmosDocumenti::instance()->createModel('DocumentiSearch');
//        $this->setBulletCount(
//            $this->makeBulletCounter(
//                Yii::$app->getUser()->getId(),
//                Documenti::className(),
//                $search->searchCreatedByMeQuery([])
//            )
//        );
    }

    /**
     * Aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
     *  
     * @inheritdoc
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
            $options = parent::getOptions(),
            ['children' => []]
        );
    }

}
