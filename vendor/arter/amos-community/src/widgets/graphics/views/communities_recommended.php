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
 * @package    arter\amos\community\widgets\graphics\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\community\AmosCommunity;
use arter\amos\community\models\Community;
use arter\amos\community\widgets\JoinCommunityWidget;
use arter\amos\core\forms\WidgetGraphicsActions;
use arter\amos\core\helpers\Html;
use arter\amos\admin\AmosAdmin;

use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;
use arter\amos\community\assets\AmosCommunityAsset;

AmosCommunityAsset::register($this);
/**
 * @var View $this
 * @var ActiveDataProvider $communitiesList
 * @var \arter\amos\community\widgets\graphics\WidgetGraphicsMyCommunities $widget
 * @var string $toRefreshSectionId
 */
/** @var AmosAdmin $adminModule */
$adminModule = AmosAdmin::instance();
    
$moduleCommunity = \Yii::$app->getModule(AmosCommunity::getModuleName());
?>
<div class="grid-item grid-item--height2">
  <div class="box-widget my-community">
    <div class="box-widget-toolbar row nom">
      <h2 class="box-widget-title col-xs-10 nop"><?= AmosCommunity::t('amoscommunity', 'My communities') ?></h2>
      <?php 
      if (isset($moduleCommunity) && !$moduleCommunity->hideWidgetGraphicsActions) {
        echo WidgetGraphicsActions::widget([
          'widget' => $widget,
          'tClassName' => AmosCommunity::className(),
          'actionRoute' => ['/community/community-wizard/introduction'],
          'toRefreshSectionId' => $toRefreshSectionId,
          'permissionCreate' => 'COMMUNITY_CREATE'
        ]);
      }
      ?>
    </div>
    <section>
    <?php Pjax::begin(['id' => $toRefreshSectionId]); ?>
      <div role="listbox">
      <?php
        $communitiesList = $communitiesList->getModels();
        if (count($communitiesList) == 0) {
          $textReadAll = AmosCommunity::t('amoscommunity', '#addCommunity');
          $linkReadAll = ['/community/community-wizard/introduction'];
          echo '<div class="list-items list-empty clearfixplus"><h2 class="box-widget-subtitle">' 
          . AmosCommunity::t('amoscommunity', '#noCommunity') 
          . '</h2></div>';
        } else {
          if ($linkToSubcommunities) {
            $textReadAll = AmosCommunity::t('amoscommunity', 'View Community List');
            $linkReadAll = ['/community/subcommunities/my-communities'];
          } else {
            $textReadAll = AmosCommunity::t('amoscommunity', 'View Community List');
            $linkReadAll = ['/community/community/my-communities'];
          }
        ?>
        <div class="list-items clearfixplus">
        <?php
          foreach ($communitiesList as $community):
          /** @var Community $community */
        ?>
          <div class="col-xs-12 widget-listbox-option" role="option">
            <article class="col-xs-12 nop">
              <div class="container-img">
              <?= \arter\amos\community\widgets\CommunityCardWidget::widget([
                'model' => $community, 
                'imgStyleDisableHorizontalFix' => true
               ]);
              ?>
              </div>
              <div class="container-text">
                <div class="col-xs-12 nop">
                  <h2 class="box-widget-subtitle">
                  <?php
                    $decode_name = strip_tags($community->name);
                    if (strlen($decode_name) > 60) {
                      $stringCut = substr($decode_name, 0, 60);
                      echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                    } else {
                      echo $decode_name;
                    }
                  ?>
                  </h2>
                </div>
                <div class="col-xs-12 box-widget-text nop nom">
                  <p>
                  <?php
                    $decode_description = strip_tags($community->description);
                    if (strlen($decode_description) > 60) {
                      $stringCut = substr($decode_description, 0, 60);
                      echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                    } else {
                      echo $decode_description;
                    }
                  ?>
                  </p>
                </div>
              </div>
            </article>
            <?= JoinCommunityWidget::widget(['model' => $community, 'divClassBtnContainer' => 'pull-right']) ?>
          </div>
        <?php endforeach; ?>
      </div>
      <?php
        }
        ?>
    </div>
    <?php Pjax::end(); ?>
  </section>
  <div class="read-all"><?php
  if (Yii::$app->user->can('COMMUNITY_CREATE')) {
    echo Html::a($textReadAll, $linkReadAll, ['class' => '']);
  }
  ?></div>
  </div>
</div>