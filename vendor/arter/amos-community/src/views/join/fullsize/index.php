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
use arter\amos\core\icons\AmosIcons;
use arter\amos\community\utilities\CommunityUtil;

\arter\amos\dashboard\assets\DashboardFullsizeAsset::register($this);
$this->params['checkedByDefault'] = false;

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
    <nav>
        <div class="container-custom">
            <div class="wrap-plugins row">
                <div id="widgets-icon" class="widgets-icon col-xs-12" role="menu">
                    <?php if ($model->hide_participants == 0 && $model->showParticipantWidget()) { ?>
                        <?php
                        $urlDisplayParticipantsMm = '';
                        $showBox                  = true;
                        if ($model->context == 'arter\amos\events\models\Event') {
                            $urlDisplayParticipantsMm = "/events/event/participants?communityId={$model->id}";
                            if (method_exists(new \arter\amos\events\utility\EventsUtility(),
                                    'hasPrivilegesLoggedUser')) {
                                $showBox = false;
                                $event   = \arter\amos\events\models\Event::findOne(['community_id' => $model->id]);
                                if ($event) {
                                    $showBox = \arter\amos\events\utility\EventsUtility::hasPrivilegesLoggedUser($event);
                                }
                            } else {
                                $showBox = true;
                            }
                        } else {
                            $urlDisplayParticipantsMm = "/community/community/participants?communityId={$model->id}";
                        }
                        if ($showBox) :
                            ?>

                            <?php
                            if (
                                \Yii::$app->getModule('community')->showCommunitiesParticipantPluging == true
                                ||
                                (\Yii::$app->getModule('community')->showCommunitiesParticipantPluging == false && CommunityUtil::loggedUserIsCommunityManager($model->id))) :
                                ?>
                                <div class="square-box" data-code="arter\amos\admin\widgets\icons\WidgetIconUserProfile">
                                    <div class="square-content item-widget plugin-partecipants">
                                        <a class="dashboard-menu-item" href="<?= $urlDisplayParticipantsMm ?>"
                                           title=<?= AmosCommunity::t('amoscommunity', "#platform_user_list") ?> role="menuitem"
                                           class="sortableOpt1">
                                            <span class="badge"></span>
                                            <span class="">
                                                <?=
                                                AmosIcons::show('user', [], AmosIcons::IC)
                                                ?>
                                                <span class="icon-dashboard-name pluginName">
                                                    <?=
                                                    AmosCommunity::tHtml('amoscommunity', 'Participants')
                                                    ?>
                                                </span>
                                            </span>
                                        </a>
                                    </div>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php } ?>

                    <?php
                    if (\Yii::$app->getModule('community')->showSubcommunitiesWidget === true && $model->showSubCommunityWidget()) {
                        $widgetSubcommunities = Yii::createObject($model->getPluginWidgetClassname());
                        echo $widgetSubcommunities::widget();
                    }
                    if ($model->context == 'arter\amos\projectmanagement\models\Projects') {
                        /** @var \arter\amos\core\record\Record $contentObject */
                        $contentObject   = Yii::createObject(arter\amos\projectmanagement\models\Projects::className());
                        $widgetClassname = $contentObject->getPluginWidgetClassname();
                        $widget          = Yii::createObject($widgetClassname);
                        echo $widget::widget();
                    }
                    ?>

                    <?php
                    echo \arter\amos\dashboard\widgets\SubDashboardWidget::widget([
                        'model' => $model,
                        'widgets_type' => 'ICON',
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </nav>

    <div class="community-description">
        <div class="container-custom">
            <?= $model->description ?>
        </div>
    </div>

    <?php
    echo \arter\amos\dashboard\widgets\SubDashboardFullsizeWidget::widget([
        'model' => $model,
        'widgets_type' => 'GRAPHIC',
    ]);
    ?>


</div>
