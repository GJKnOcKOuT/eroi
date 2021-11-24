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
 * @package    arter\amos\news\views\news-categorie
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\attachments\components\AttachmentsInput;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\CreatedUpdatedWidget;
use arter\amos\core\forms\RequiredFieldsTipWidget;
use arter\amos\news\AmosNews;
use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var arter\amos\news\models\NewsCategorie $model
 * @var yii\widgets\ActiveForm $form
 */

$module = \Yii::$app->getModule('news');
$enableCategoriesForCommunity = $module->enableCategoriesForCommunity;
$filterCategoriesByRole = $module->filterCategoriesByRole;
?>

<div class="news-categorie-form">

    <?php
    $form = ActiveForm::begin([
        'options' => ['enctype' => 'multipart/form-data'] // important
    ]);

    $customView = Yii::$app->getViewPath() . '/imageField.php';
    ?>

    <?php $this->beginBlock('dettagli'); ?>
    <div class="row">
        <div class="col-lg-6 col-sm-6">

            <?= $form->field($model, 'titolo')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'sottotitolo')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6 col-sm-6">
            <div class="col-lg-8 col-sm-8 pull-right">
                <?= $form->field($model, 'categoryIcon')->widget(AttachmentsInput::classname(), [
                    'options' => [ // Options of the Kartik's FileInput widget
                        'multiple' => false, // If you want to allow multiple upload, default to false
                        'accept' => "image/*"
                    ],
                    'pluginOptions' => [ // Plugin options of the Kartik's FileInput widget
                        'maxFileCount' => 1,
                        'showRemove' => false,// Client max files,
                        'indicatorNew' => false,
                        'allowedPreviewTypes' => ['image'],
                        'previewFileIconSettings' => false,
                        'overwriteInitial' => false,
                        'layoutTemplates' => false
                    ]
                ]) ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">

            <?= $form->field($model, 'descrizione_breve')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?= $form->field($model, 'descrizione')->widget(\yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'buttonsHide' => [
                        'image',
                        'file'
                    ],
                    'lang' => substr(Yii::$app->language, 0, 2)
                ]
            ]) ?>
        </div>
    </div>

    <?php if($filterCategoriesByRole) {
        $whiteRoles = $module->whiteListRolesCategories;
        $roles =  array_combine($whiteRoles, $whiteRoles);
        ?>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
                <?= $form->field($model, 'newsCategoryRoles')->widget(\kartik\select2\Select2::className(),[
                    'data' => $roles,
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'options' => ['multiple' => true, 'placeholder' => AmosNews::t('amosnews', 'Select...')]
                ])->label(AmosNews::t('amosnews', 'Roles')) ?>
            </div>

        </div>
    <?php  } ?>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?= $form->field($model, 'notify_category')->checkbox() ?>
        </div>
    </div>
    <?php if($enableCategoriesForCommunity) {?>
        <hr>
        <h3><?= AmosNews::t('amosnews', 'Configuration for community')?></h3>
        <div class="row">
            <div class="col-lg-6 col-sm-12">
                <?= $form->field($model, 'newsCategoryCommunities')->widget(\kartik\select2\Select2::className(),[
                    'data' => \yii\helpers\ArrayHelper::map(\arter\amos\community\models\Community::find()->all(), 'id', 'name'),
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                    'options' => ['multiple' => true, 'placeholder' => AmosNews::t('amosnews', 'Select...')]
                ])->label(AmosNews::t('amosnews', 'Community')) ?>
            </div>
            <div class="col-lg-6 col-sm-12">
                <?= $form->field($model, 'visibleToCommunityRole')->widget(\kartik\select2\Select2::className(),[
                    'data' => [
                        'COMMUNITY_MANAGER' => AmosNews::t('amosnews', 'Community manager'),
                        'PARTICIPANT' => AmosNews::t('amosnews', 'Participant'),
                    ],
                    'options' =>  [
                        'placeholder' => 'Select...',
                        'multiple' => true

                    ]
                ])->label(AmosNews::t('amosnews', 'Visible to Community roles')); ?>
            </div>
        </div>
<!--        <div class="row">-->
<!--            <div class="col-lg-12 col-sm-12">-->
<!--                --><?php //echo $form->field($model, 'publish_only_on_community')->checkbox()->label(AmosNews::t('amosnews', 'Publish Only On Community')) ?>
<!--            </div>-->
<!--        </div>-->
    <?php } ?>
    <div class="clearfix"></div>
    <?php $this->endBlock(); ?>

    <?php
    $itemsTab[] = [
        'label' => AmosNews::t('amosnews', 'Dettagli '),
        'content' => $this->blocks['dettagli'],
    ];
    ?>

    <?= Tabs::widget([
        'encodeLabels' => false,
        'items' => $itemsTab
    ]);
    ?>
    <?= RequiredFieldsTipWidget::widget() ?>
    <?= CreatedUpdatedWidget::widget(['model' => $model]) ?>
    <?php
    $config = [
        'model' => $model
    ];
    ?>
    <?= CloseSaveButtonWidget::widget($config); ?>
    <?php ActiveForm::end(); ?>
</div>
