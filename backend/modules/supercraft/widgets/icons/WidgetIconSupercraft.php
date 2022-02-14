<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\tickets\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\supercraft\widgets\icons;

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\widget\WidgetIcon;
use Yii;
use yii\helpers\ArrayHelper; 

class WidgetIconSupercraft extends WidgetIcon {

    public function init() {
        parent::init();

        $this->setLabel(\arter\amos\core\module\BaseAmosModule::tHtml('amosapp','SUPERCraft'));
        $this->setDescription(Yii::t('amosapp', 'SUPERCraft'));

        $this->setIconFramework(AmosIcons::AM);
        $this->setIcon('email');
        
        $this->setUrl(Yii::$app->urlManager->createUrl(['/supercraftcss']));
        $this->setCode('SUPERCRAFT');
        $this->setModuleName('SUPERCraft');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
                    'bk-backgroundIcon',
                    'color-greyColor'
        ]));
    }

//    public function getOptions() {
//        $options = parent::getOptions();
//
//        //aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
//        return ArrayHelper::merge($options, ["children" => $this->getWidgetsIcon()]);
//    }

    /**
     * Recupera i widget figli da far visualizzare nella dashboard secondaria    
     * @return [arter\amos\core\widget\WidgetIcon] Array con i widget della dashboard
     */
//    public function getWidgetsIcon() {
//        $widgets = [];
//
//        $widget = \arter\amos\dashboard\models\AmosWidgets::find()->andWhere(['module' => 'registry'])->andWhere(['type' => 'ICON'])->andWhere(['!=', 'child_of', NULL])->all();
//
//        foreach ($widget as $Widget) {
//            $className = (strpos($Widget['classname'], '\\') === 0)? $Widget['classname'] : '\\' . $Widget['classname'];
//            $widgetChild = new $className;
//            if($widgetChild->isVisible()){
//                $widgets[] = $widgetChild->getOptions();
//            }
//        }
//        return $widgets;
//    }

}
