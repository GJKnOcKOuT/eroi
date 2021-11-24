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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\community\AmosCommunity;
use arter\amos\community\widgets\icons\WidgetIconAccademyDocument;

/**
 * @var $this \yii\web\View
 * @var $model \arter\amos\community\models\Community
 */
// title not active in layout view_network
//$this->title = AmosCommunity::t('amoscommunity', 'Welcome to the community!');
//if (!is_null($model->parent_id)) {
//    $this->title = AmosCommunity::t('amoscommunity', '#welcome_to_subcommunity');
//}
?>

<div class="actions-dashboard-container community-dashboard-container">

    <ul id="widgets-icon" class="bk-sortableIcon plugin-list p-t-25" role="menu">

        <?php if ($model->hide_participants == 0 && $model->showParticipantWidget()) { ?>
            <?php
                $urlDisplayParticipantsMm = '';
                $showWidget = true;
                if ($model->context == 'arter\amos\events\models\Event') {
                    $urlDisplayParticipantsMm = "/events/event/participants?communityId={$model->id}";
                    if(method_exists(new \arter\amos\events\utility\EventsUtility(), 'hasPrivilegesLoggedUser')) {
                        $showWidget = false;
                        $event = \arter\amos\events\models\Event::findOne(['community_id' => $model->id]);
                        if($event) {
                            $showWidget = \arter\amos\events\utility\EventsUtility::hasPrivilegesLoggedUser($event);
                        }
                    } else {
                        $showWidget = true;
                    }
                } else {
                    $urlDisplayParticipantsMm = "/community/community/participants?communityId={$model->id}";
                }
                if($showWidget) :
            ?>
            <li class="item-widget col-custom" data-code="arter\amos\admin\widgets\icons\WidgetIconUserProfile">
                <a href="<?= $urlDisplayParticipantsMm; ?>"
                   title=<?= AmosCommunity::t('amoscommunity', "#platform_user_list") ?> role="menuitem"
                   class="sortableOpt1">
                    <span class="badge"></span>
                    <span class="color-primary bk-backgroundIcon color-darkGrey">
                        <span class="dash dash-users"> </span>
                        <span class="icon-dashboard-name pluginName">
                            <?= AmosCommunity::t('amoscommunity', 'Participants') ?>
                        </span>
                    </span>
                </a>
            </li>
            <?php endif; ?>
        <?php }
        if (\Yii::$app->getModule('community')->showSubcommunitiesWidget === true || $model->showSubCommunityWidget()) {
            $widgetSubcommunities = Yii::createObject($model->getPluginWidgetClassname());
            echo $widgetSubcommunities::widget();
        }
        if ($model->context == 'arter\amos\projectmanagement\models\Projects') {
            /** @var \arter\amos\core\record\Record $contentObject */
            $contentObject = Yii::createObject(arter\amos\projectmanagement\models\Projects::className());
            $widgetClassname = $contentObject->getPluginWidgetClassname();
            $widget = Yii::createObject($widgetClassname);
            echo $widget::widget();
        }?>




        <?php
            echo \arter\amos\dashboard\widgets\SubDashboardWidget::widget([
                'model' => $model,
                'widgets_type' => 'ICON',
            ]);
        ?>
    </ul>
    <div class="clearfix"></div>


    <?php
        echo \arter\amos\dashboard\widgets\SubDashboardWidget::widget([
            'model' => $model,
            'widgets_type' => 'GRAPHIC',
        ]);
    ?>

</div>
