<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/** @var \arter\amos\dashboard\models\AmosUserDashboards $currentDashboard * */

/** @var \yii\web\View $this * */

use arter\amos\core\icons\AmosIcons;
use arter\amos\dashboard\AmosDashboard;
use arter\amos\core\utilities\ModalUtility;
use yii\helpers\Html;
use yii\widgets\Pjax;

\arter\amos\dashboard\assets\DashboardFullsizeAsset::register($this);

AmosIcons::map($this);

$this->title = $this->context->module->name;

$moduleL = \Yii::$app->getModule('layout');
$layoutModuleSet = isset($moduleL);

?>

<input type="hidden" id="saveDashboardUrl"
       value="<?= Yii::$app->urlManager->createUrl(['dashboard/manager/save-dashboard-order']); ?>"/>
<input type="hidden" id="currentDashboardId" value="<?= $currentDashboard['id'] ?>"/>
<?php
//DA SOSTITUIRE
?>
<div id="dashboard-edit-toolbar" class="hidden pull-right">
    <?=
    Html::a(AmosDashboard::tHtml('amosdashboard', 'Salva'), 'javascript:void(0);', [
        'id' => 'dashboard-save-button',
        'class' => 'btn btn-success bk-saveOrder',
        'title' => AmosDashboard::t('amosdashboard', 'Salva ordinamento dashboard')
    ]);
    ?>

    <?=
    Html::a(AmosDashboard::tHtml('amosdashboard', 'Annulla'), \yii\helpers\Url::current(), [
        'class' => 'btn btn-danger bk-saveDelete',
        'title' => AmosDashboard::t('amosdashboard', 'Annulla ordinamento dashboard')
    ]);
    ?>
</div>

<?php
/*
 * @$widgetsIcon elenco dei plugin ad icona
 * @$widgetsGrafich elenco dei plugin ad grafici
 * @$dashboardsNumber numero delle dashboard da mostrare
 */
?>
<!-- ICONS PLUGINS -->
<nav data-dashboard-index="<?= $currentDashboard->slide ?>">
    <div class="container-custom">
        <div class="wrap-plugins row">
            <?php Pjax::begin([
                'id' => 'widget-icons-pjax-block',
            ]) ?>
            <div id="widgets-icon" class="widgets-icon col-xs-12" role="menu">
                <?php
                //indice di questa dashboard
                $thisDashboardIndex = 'dashboard_' . $currentDashboard->slide;

                //recupera i widgets di questa dashboard
                $thisDashboardWidgets = $currentDashboard->amosWidgetsSelectedIcon;

                if ($thisDashboardWidgets && count($thisDashboardWidgets) > 0) {

                    foreach ($thisDashboardWidgets as $widget) {
                        $widgetObj = Yii::createObject($widget['classname']);
                        echo $widgetObj::widget();
                    }
                } else {
                    AmosDashboard::tHtml('amosdashboard', 'Non ci sono widgets selezionati per questa dashboard');
                }
                ?>
            </div>
            <?php Pjax::end() ?>
        </div>
    </div>
</nav>

<!-- WIDGET GRAFICI -->
<div class="wrap-graphic-widget">
    <div id="widgets-graphic">
        <?php
        //recupera i widgets di questa dashboard
        $thisDashboardWidgets = $currentDashboard->amosWidgetsSelectedGraphic;

        if ($thisDashboardWidgets && count($thisDashboardWidgets) > 0) {
            foreach ($thisDashboardWidgets as $widget) {
                $widgetObj = Yii::createObject($widget['classname']);
                ?>
                <div <?= (($layoutModuleSet) ? '' : 'class="' . $widgetObj->classFullSize . '"') ?>
                        data-code="<?= $widgetObj::classname() ?>"
                        data-module-name="<?= $widgetObj->moduleName ?>"><?= $widgetObj::widget(); ?></div>
                <?php
            }
        }
        ?>
    </div>
</div>

<!-- MODAL DASHBOARD 2 LEVEL -->
<?= ModalUtility::amosModal([
    'id' => 'modal-2liv-dashboard',
    'containerOptions' => ['class' => 'modal-utility modal-dashboard-2level'],
]);
?>






