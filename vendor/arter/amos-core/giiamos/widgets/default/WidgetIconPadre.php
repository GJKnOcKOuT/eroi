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
 * @package    arter\amos\core\giiamos\widgets\default
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

echo "<?php\n";
?>
<?php ?>
namespace <?= $data_obj->ns_4class ?>;

use arter\amos\core\widget\WidgetIcon;
use Yii;
use yii\helpers\ArrayHelper;

class <?= $data_obj->widgetName ?> extends WidgetIcon {

    public function init() {
        parent::init();

        $this->setLabel(\Yii::t('<?= $data_obj->ns_4class; ?>' , '<?= $data_obj->widgetLabel; ?>'));
        $this->setDescription(Yii::t('<?= $data_obj->ns_4class; ?>', '<?= $data_obj->widgetDescription ?>'));

        $this->setIcon('<?= $data_obj->iconClass; ?>');
        $this->setIconFramework('<?= $data_obj->iconFramework; ?>');


        $this->setUrl(Yii::$app->urlManager->createUrl(['<?= $data_obj->widgetUrl ?>']));
        $this->setModuleName('<?= $data_obj->moduleName ?>');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            '<?= $data_obj->iconColor; ?>'
        ]));
    }

    public function getOptions() {
        $options = parent::getOptions();

        //aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
        return ArrayHelper::merge($options, ["children" => $this->getWidgetsIcon()]);
    }

    /**
    * Recupera i widget figli da far visualizzare nella dashboard secondaria
    * @return [arter\amos\core\widget\WidgetIcon] Array con i widget della dashboard
    */
    public function getWidgetsIcon() {
        $widgets = [];

        $widget = \arter\amos\dashboard\models\AmosWidgets::find()->andWhere(['module' => '<?= $data_obj->moduleName; ?>'])->andWhere(['type' => 'ICON'])->andWhere(['!=', 'child_of', NULL])->all();

        foreach ($widget as $Widget) {
        $className = (strpos($Widget['classname'], '\\') === 0)? $Widget['classname'] : '\\' . $Widget['classname'];
        $widgetChild = new $className;
        if($widgetChild->isVisible()){
            $widgets[] = $widgetChild->getOptions();
        }
    }
    return $widgets;
    }

}