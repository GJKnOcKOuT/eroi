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
use arter\amos\partnershipprofiles\Module;
use arter\amos\core\forms\WidgetGraphicsActions;
use arter\amos\core\helpers\Html;
use yii\data\ActiveDataProvider;
use yii\web\View;
use yii\widgets\Pjax;
use arter\amos\core\forms\PublishedByWidget;
use arter\amos\partnershipprofiles\assets\PartnershipProfilesAsset;

/**
 * @var View $this
 * @var ActiveDataProvider $communitiesList
 * @var \arter\amos\partnershipprofiles\widgets\graphics\WidgetGraphicsLatestPartnershipProfiles $widget
 * @var string $toRefreshSectionId
 */
PartnershipProfilesAsset::register($this);
$modulePartenershipProfiles = \Yii::$app->getModule(\arter\amos\een\AmosEen::getModuleName());
?>
<div class="grid-item grid-item--height2">
  <div class="box-widget latest-partnership-profiles">
    <div class="box-widget-toolbar">
      <h2 class="box-widget-title col-xs-10 nop"><?= Module::tHtml('Module', 'Ultime Proposte di collaborazione') ?></h2>
      <?php
      if (isset($modulePartenershipProfiles) && !$modulePartenershipProfiles->hideWidgetGraphicsActions) {
        echo WidgetGraphicsActions::widget([
          'widget' => $widget,
          'tClassName' => Module::className(),
          'actionRoute' => '/partnershipprofiles/partnership-profiles/create',
          'toRefreshSectionId' => $toRefreshSectionId
        ]);
      }
      ?>
    </div>
    <section>
    <?php Pjax::begin(['id' => $toRefreshSectionId]); ?>
      <div role="listbox">
      <?php
      $listaPartnership = $listaPartnership->getModels();
      if (count($listaPartnership) == 0):
        $textReadAll = Module::t('Module', 'Aggiungi Proposta di collaborazione');
        $linkReadAll = ['/partnershipprofiles/partnership-profiles/create'];
      ?>

        <div class="list-items list-empty clearfixplus">
          <h2 class="box-widget-subtitle"><?= Module::tHtml('Module', 'Nessuna Proposta di collaborazione'); ?></h2>
        </div>
        
      <?php else:
        $textReadAll = Module::t('Module', 'Visualizza Proposte di collaborazione');
        $linkReadAll = ['/partnershipprofiles'];
      ?>
          
        <div class="list-items clearfixplus">
        <?php
        foreach ($listaPartnership as $partnership):
          /** @var \arter\amos\een\models\EenPartnershipProposal $partnership */
        ?>
          <div class="col-xs-12 widget-listbox-option" role="option">
            <article class="col-xs-12 nop">
              <div class="container-text col-xs-12 nop">
              <?= \arter\amos\notificationmanager\forms\NewsWidget::widget(['model' => $partnership]); ?>
              <?=
                PublishedByWidget::widget([
                  'model' => $partnership,
                  'layout' => '{publisher}'
                ]);
              ?>

                <h2 class="col-xs-12 nop box-widget-subtitle">
                <?php
                  if (strlen($partnership->content_title) > 100) {
                    $stringCut = substr($partnership->content_title, 0, 100);
                    echo substr($stringCut, 0, strrpos($stringCut, ' ')) . '... ';
                } else {
                  echo $partnership->content_title;
                }
                ?>
                </h2>
              </div>

              <div class="col-xs-12 footer-listbox nop">
              <?php
              $module = \Yii::$app->getModule('een');
              $moduleCwh = \Yii::$app->getModule('cwh');
              $communityConfigurationsId = null;
              if (isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
                $scope = $moduleCwh->getCwhScope();
                if (isset($scope['community'])) {
                  $communityConfigurationsId = 'communityId-' . $scope['community'];
                }
              }
              ?>

              
                <span class="pull-left"><strong><?= Module::t('amoseen', 'data scadenza: ') ?><?=  \Yii::$app->formatter->asDate($partnership->datum_deadline) ?></strong></span>

                <span class="pull-right">
                  <?= Html::a(Module::t('amoseen', 'LEGGI'), ['../een/een-partnership-proposal/view', 'id' => $partnership->id], ['class' => 'btn btn-navigation-primary']); ?>
                </span>
              </div>

              <div class="clearfix"></div>
            </article>
          </div>
          <?php endforeach; ?>
        </div>
        <?php endif; ?>
      </div>
      <?php Pjax::end(); ?>
    </section>
    <div class="read-all"><?= Html::a($textReadAll, $linkReadAll, ['class' => '']); ?></div>
  </div>
</div>