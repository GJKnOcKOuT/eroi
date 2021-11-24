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
 * @package    arter\amos\layout\views\layouts\parts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\models\Community;
use arter\amos\core\helpers\Html;
use arter\amos\events\AmosEvents;
use arter\amos\events\models\Event;
use arter\amos\events\utility\EventsUtility;
use arter\amos\layout\Module;

/**
 * @var \arter\amos\events\models\Event $model
 */

/** @var AmosEvents $eventsModule */
$eventsModule = AmosEvents::instance();

$showGoToCommunityButton = (
    !$eventsModule->hasProperty('enableCommunitySections') ||
    ($eventsModule->hasProperty('enableCommunitySections') && EventsUtility::showCommunityButtonInView($model, $eventsModule))
);

if (isset($model)) {

    if ($model instanceof Community) {
        /** @var Event $eventModel */
        $eventModel = $eventsModule->createModel('Event');
        $model = $eventModel::findOne(['community_id' => $community->id]);
    }

    $viewUrl = $model->getFullViewUrl();
    $controller = Yii::$app->controller;
    $isActionUpdate = ($controller->action->id == 'update');
    $confirm = $isActionUpdate ? [
        'confirm' => \arter\amos\core\module\BaseAmosModule::t('amoscore', '#confirm_exit_without_saving')
    ] : null;
    ?>

    <div class="network-container col-xs-12 nop">
        <!--        <div class="col-xs-12 col-sm-2 col-lg-1 nop back-to-dashboard">-->
        <?php /*
            echo Html::a(
                Html::tag('span', '', ['class' => 'am am-mail-reply-all']) .
                Html::tag('span', Module::t('amoslayout', '#network_scope_return_to') . ' ' . Yii::$app->name),
                Yii::$app->homeUrl
            );
            */ ?>
        <!--        </div>-->

        <!-- BEGIN: event data -->
        <!--        <div class="network-box col-xs-12 col-sm-10 col-lg-11 nop">-->
        <div class="network-box col-xs-12 col-sm-12 col-lg-12 nop">
            <?php
            $url = '/img/img_default.jpg';
            if (!empty($model->eventLogo)) {
                $url = $model->eventLogo->getUrl('square_large', false, true);
            }
            Yii::$app->imageUtility->methodGetImageUrl = 'getUrl';
            $roundImage = Yii::$app->imageUtility->getRoundImage((empty($model->eventLogo)? null : $model->eventLogo));
            $logo = Html::img($url,
                [
                    'class' => $roundImage['class'],
                    //'style' => "margin-left: " . $roundImage['margin-left'] . "%; margin-top: " . $roundImage['margin-top'] . "%;",
                    'alt' => $model->getAttributeLabel('eventLogo')
                ]);
            ?>

            <div class="col-xs-2 col-sm-2 nop">
                <div class="container-round-img">
                    <?=
                    Html::a($logo, $viewUrl,
                        [
                            'title' => Module::t('amosevents', 'View events'),
                            'data' => $confirm
                        ]
                    )
                    ?>
                </div>
            </div>

            <div class="col-sm-10 col-xs-10 nop network-infos">
                <?php /*echo CreatedUpdatedWidget::widget(['model' => $model, 'isTooltip' => true])*/
                   if(isset(Yii::$app->params['isPoi']) && (Yii::$app->params['isPoi'] === true) && ($community->id == 2965))
                   {
                       $viewUrl = \Yii::$app->params['platform']['backendUrl']."/community/join?id=2965";
                   }
                ?>
                <?php $modelName = ''; ?>
                <?php $modelName = Html::a($model->getTitle(), $viewUrl, [
                    'title' => Module::t("amosevents", "View events"),
                    'data' => $confirm
                ]) ?>
                <!--<p class="network-info">
                        <span class="network-type"><?php /*= $model->communityType->name */ ?></span>
                        <span class="network-created-by"><?php /*= Module::tHtml('amoscommunity', 'Created by') . ' ' . '<strong>' . $model->createdByUser->profile->__toString() . '</strong>'; */ ?></span>
                    </p>-->
                <p class="network-name">
                    <?= $modelName ?>
                </p>
                <span class="network-bottom-label"><?php echo Module::t('amoslayout', '#network_scope_bottom_label_event') ?></span>
                <?php
                $appController = Yii::$app->controller;
                $hideButton = (($appController->id == 'event') && ($appController->action->id == 'view'));
                $hideButton = $hideButton || (isset(Yii::$app->params['isPoi']) && (Yii::$app->params['isPoi'] === true) && ($community->id == 2965));
                ?>
                <?php if (!$hideButton): ?>
                    <?= Html::a(Module::t('amoslayout', '#network_scope_view_details'), $viewUrl, [
                        'title' => Module::t("amosevents", "View event"),
                        'class' => 'btn btn-primary pull-right',
                        'data' => $confirm
                    ]) ?>
                <?php endif; ?>
            </div>

        </div>
    </div>
    <!-- END: community data -->
<?php } ?>
