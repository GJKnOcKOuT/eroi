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
 * @package    arter\amos\community\views\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;
use arter\amos\community\models\Community;
use arter\amos\community\utilities\CommunityUtil;
use arter\amos\core\helpers\Html;
use kartik\select2\Select2;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var arter\amos\community\models\search\CommunitySearch $model
 * @var yii\widgets\ActiveForm $form
 */

$moduleTag = Yii::$app->getModule('tag');

/** @var AmosCommunity $moduleCommunity */
$moduleCommunity = Yii::$app->getModule(AmosCommunity::getModuleName());
$enableAutoOpenSearchPanel = !isset(\Yii::$app->params['enableAutoOpenSearchPanel']) || \Yii::$app->params['enableAutoOpenSearchPanel'] === true;

?>
<div class="community-search element-to-toggle" data-toggle-element="form-search">

    <?php $form = ActiveForm::begin([
        'action' => (isset($originAction) ? [$originAction] : ['index']),
        'method' => 'get',
    ]);
    
    echo Html::hiddenInput("enableSearch", $enableAutoOpenSearchPanel);
    echo Html::hiddenInput("currentView", Yii::$app->request->getQueryParam('currentView'));
    
    ?>

    <div class="col-xs-12">
        <h2><?= AmosCommunity::tHtml('amoscommunity', 'Search by') ?></h2>
    </div>


    <div class="col-sm-6 col-lg-4">
        <?= $form->field($model, 'name')->textInput(['placeholder' => AmosCommunity::t('amoscommunity', 'Search by name')]) ?>
    </div>

    <?php if (!$moduleCommunity->hideCommunityTypeSearchFilter): ?>
        <div class="col-sm-6 col-lg-4">
            <?= $form->field($model, 'community_type_id')->widget(Select2::className(), [
                'data' => CommunityUtil::getCommunityTypeReadyForSelect(),
                'language' => 'it',
                'options' => ['multiple' => false,
                    'id' => 'communityType' . $model->id,
                    'placeholder' => AmosCommunity::t('amoscommunity', 'Select') . '...',
                    'class' => 'dynamicCreation',
                    'data-model' => 'community-type',
                    'data-field' => 'id',
                    'data-module' => 'community',
                    'data-entity' => 'community-type',
                    'data-toggle' => 'tooltip',
                    'disabled' => false
                ],
                'pluginOptions' => [
                    'allowClear' => true
                ],
                //TODO check - following lines commented because cause a javascript error that does not allow to select metching tag to search in widget tag below
//            'pluginEvents' => [
//                "select2:open" => "dynamicInsertOpening"
//            ]
      ])->label($model->getAttributeLabel('communityType'), ['for' => 'communityType' . $model->id])
      ?>
</div>
<?php endif; ?>

<?php if (isset($moduleTag) && in_array(Community::className(), $moduleTag->modelsEnabled) && $moduleTag->behaviors): ?>
<div class="col-xs-12">
<?php
          $params = \Yii::$app->request->getQueryParams();
          /* echo \arter\amos\tag\widgets\TagWidget::widget([
            'model' => $model,
            'attribute' => 'tagValues',
            'form' => $form,
            'isSearch' => true,
            'form_values' => isset($params[$model->formName()]['tagValues']) ? $params[$model->formName()]['tagValues'] : []
            ]); */
          ?>
      </div>
<?php endif; ?>

<div class="col-xs-12">
  <div class="pull-right">
  <?= Html::a(AmosCommunity::tHtml('amoscommunity', 'Cancel'), [Yii::$app->controller->action->id, 'currentView' => Yii::$app->request->getQueryParam('currentView')],
    ['class' => 'btn btn-secondary', 'title' => AmosCommunity::t('amoscommunity', 'Cancel search')])
  ?>
  <?= Html::submitButton(AmosCommunity::tHtml('amoscommunity', 'Search'), ['class' => 'btn btn-navigation-primary', 'title' => AmosCommunity::t('amoscommunity', 'Start search')]) ?>
  </div>
</div>

<div class="clearfix"></div>
<?php ActiveForm::end(); ?>
</div>