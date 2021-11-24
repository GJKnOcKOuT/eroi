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
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\helpers\Html;
use arter\amos\layout\Module;

$moduleCommunity = Yii::$app->getModule('community');
if (isset($community)) {
    $viewUrl            = ['/community/join/index?id='.$community->id];
    $fixedCommunityType = (!is_null($moduleCommunity->communityType));
    ?>

    <div class="network-container community-network-container col-xs-12 nop">
        <div class="col-xs-12 back-to-dashboard">
            <?=
            Html::a(
                Html::tag('span', '', ['class' => 'am am-mail-reply-all']).
                Html::tag('span', Module::t('amoslayout', '#network_scope_exit_from_community')), Yii::$app->homeUrl
            );
            ?>
        </div>

        <!-- BEGIN: community data -->
        <div class="network-box col-xs-12 col-sm-12 col-lg-12">
            <?php
            $url                = '/img/img_default.jpg';
            if (!empty($community->communityLogo)) {
                $url = $community->communityLogo->getUrl('scope_community_old', false, true);
            }
            Yii::$app->imageUtility->methodGetImageUrl = 'getUrl';
            $roundImage                                = Yii::$app->imageUtility->getRoundImage((empty($community->communityLogo)
                    ? null : $community->communityLogo));
            $logo                                      = Html::img($url,
                    [
                    'class' => $roundImage['class'],
                    'alt' => $community->getAttributeLabel('communityLogo')
            ]);
            ?>

            <div class="col-md-3 col-xs-12">
                <div class="container-square-img">
                    <?=
                    Html::a($logo, $viewUrl,
                        [
                        'title' => Module::t('amoscommunity', 'View community'),
                        'data' => $confirm
                        ]
                    )
                    ?>
                </div>
            </div>

            <div class="col-md-9 col-xs-12 network-infos">
                <?=
                ContextMenuWidget::widget([
                    'model' => $community,
                    'actionModify' => "/community/community/update?id=".$community->id,
                    'disableDelete' => true,
                    'mainDivClasses' => ''
                ])
                ?>
                <?= CreatedUpdatedWidget::widget(['model' => $community, 'isTooltip' => true]) ?>
                <?php $communityName                             = ''; ?>
                <?php
                $communityName                             = Html::a($community->name, $viewUrl,
                        [
                        'title' => Module::t("amoscommunity", "View community"),
                        'data' => $confirm
                    ])
                ?>
                <?php if (!$fixedCommunityType): ?>
                    <p class="network-info">
                        <span class="network-type"><?= $community->communityType->name ?></span>
                        <span class="network-created-by"><?= Module::tHtml('amoscommunity', 'Created by').' '.'<strong>'.$community->createdByUser->profile->__toString().'</strong>'; ?></span>
                    </p>
                <?php endif; ?>
                <p class="network-name">
                    <?= $communityName ?>
                </p>
                <span class="network-bottom-label"><?= Module::t('amoslayout', '#network_scope_bottom_label_community') ?></span>
                <?php
                if (!empty(\Yii::$app->params['isPoi']) && \Yii::$app->params['isPoi'] == true && $community->id == 2750) {

                } else {
                    ?>

                    <?=
                    Html::a(Module::t('amoslayout', '#network_scope_view_details'), $viewUrl,
                        [
                        'title' => Module::t("amoscommunity", "View community"),
                        'class' => 'btn btn-primary pull-right',
                        'data' => $confirm
                    ])
                    ?>
                <?php } ?>
            </div>

        </div>
    </div>
    <!-- END: community data -->
<?php } ?>
