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
use arter\amos\community\models\CommunityType;
use arter\amos\community\widgets\JoinCommunityWidget;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\helpers\Html;
use arter\amos\layout\assets\BaseAsset;
use arter\amos\layout\Module;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\report\widgets\ReportDropdownWidget;

$asset = BaseAsset::register($this);

$moduleCommunity = Yii::$app->getModule('community');
if (isset($community)) {
    arter\amos\community\assets\AmosCommunityAsset::register($this);
    $viewUrl            = ['/community/join/index?id='.$community->id];
    $exitUrl            = (!empty(\Yii::$app->homeUrl)? \Yii::$app->homeUrl : ['/dashboard']);
    $fixedCommunityType = (!is_null($moduleCommunity->communityType));
    $team = \amos\challenge\models\ChallengeTeam::find()->andWhere(['community_id' => $community->id])->one();
    $urlImageTeam = !empty($team->mainImage) ? $team->mainImage->getUrl('scope_community', false, true) : null;
    ?>
    <div class="network-container community-network-container fullscreen-network-container">
        <!-- BEGIN: community data -->
        <div class="network-box">
            <img src="<?= $asset->baseUrl ?>/img/bg-community.jpg">

            <div class="network-infos">
                <div class="container-custom">
                    <div class="header-community">
                        <div class="poster-community">
                            <?php
                            $url = '/img/img_default.jpg';
                            if (!empty($urlImageTeam)) {
                                $url = $urlImageTeam;
                            }
                            //            Yii::$app->imageUtility->methodGetImageUrl = 'getUrl';
                            //            $roundImage = Yii::$app->imageUtility->getRoundImage((empty($community->communityLogo)
                            //                ? null : $community->communityLogo));

                            echo $logo = Html::img($url,
                                [
                                    'alt' => $community->getAttributeLabel('communityLogo')
                                ]);
                            ?>
                        </div>
                        <div class="control-community">
                            <!--< ?= CreatedUpdatedWidget::widget(['model' => $community, 'isTooltip' => true]) ?>-->
<!--                            --><?php //$communityName = ''; ?>
<!--                            --><?php //$communityName = Html::a($community->name, $viewUrl,
//                                [
//                                    'title' => Module::t("amoscommunity", "View community"),
//                                    'data' => $confirm
//                                ]) ?>

                            <h1 class="network-name"><?= $community->name ?></h1>

                            <?php if (!$fixedCommunityType): ?>
                                <?php
                                switch ($community->community_type_id):
                                    case CommunityType::COMMUNITY_TYPE_CLOSED :
                                        $classType = 'closed';
                                        break;
                                    case CommunityType::COMMUNITY_TYPE_OPEN :
                                        $classType = 'open';
                                        break;
                                    case CommunityType::COMMUNITY_TYPE_PRIVATE :
                                        $classType = 'private';
                                        break;
                                    default:
                                        $classType = '';
                                endswitch;
                                ?>
                            <div class="community-status <?= $classType ?>"><?= Module::t('amoscommunity', $community->communityType->name) ?></div>
                            <?php endif; ?>
                            <p> <?= Module::t("amoslayout", "Benvenuto nell'area di lavoro del tuo team") ?> </p>
                        </div>

                        <div class="network-footer">
                            <?php
                            //community view
                            if (isset($this->params['CommunityParams']['outsideCommunity']) && $this->params['CommunityParams']['outsideCommunity']):
                                ?>
                                <?=
                                JoinCommunityWidget::widget([
                                'model' => $community,
                                'isProfileView' => true,
                                'btnClass' => 'enter-community',
                                    ])


                                    ?>

<!--                                <div class="wrap-icons">-->
<!---->
<!--                                    < ?= ReportDropdownWidget::widget([-->
<!--                                        'model' => $community,-->
<!--                                    ])-->
<!--                                    ?>-->
<!---->
<!--                                    < ?= CreatedUpdatedWidget::widget(['model' => $community, 'isTooltip' => true]) ?>-->
<!---->
<!--                                    < ?= ContextMenuWidget::widget([-->
<!--                                        'model' => $community,-->
<!--                                        'actionModify' => "/community/community/update?id=" . $community->id,-->
<!--                                        'optionsModify' => [-->
<!--                                            'class' => 'community-modify',-->
<!--                                        ],-->
<!--                                        'actionDelete' => "/community/community/delete?id=" . $community->id,-->
<!--                                        'layout' => '@vendor/arter/amos-layout/src/views/widgets/context_menu_widget_network_scope.php'-->
<!--                                    ]) ?>-->
<!--                                </div>-->
                            <?php
                            else:
                                //community dashboard
                                ?>

                                <?=
                                Html::a(Module::t('amoslayout', '#network_scope_exit_from_community'),
                                    $exitUrl,
                                    [
                                'class' => 'back-to-dashboard'
                                ]);
                                ?>

                                <?php if (\Yii::$app->user->can('COMMUNITY_UPDATE',
                                        ['model' => $community])) : ?>
                                    <?php echo
                                    Html::a(\arter\amos\core\icons\AmosIcons::show('modifica', [],
                                            \arter\amos\core\icons\AmosIcons::IC),
                                        '/challenge/challenge-team/update?id='.$team->id, ['class' => 'btn btn-icon'])
                                ?>
                                 <?php endif; ?>

                            <?php endif; ?>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: community data -->
<?php } ?>
