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
 * @package    @backend/modules/aster_een/views
 * @author     Elite Division S.r.l.
 */
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\forms\editors\Select;
use arter\amos\core\forms\RequiredFieldsTipWidget;
use arter\amos\core\forms\Tabs;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use kartik\datecontrol\DateControl;
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\helpers\Url;
use yii\redactor\widgets\Redactor;

/**
 * @var yii\web\View $this
 * @var arter\amos\een\models\EenTagS3TagEenMm $model
 * @var yii\widgets\ActiveForm $form
 */
?>
<div class="een-tag-s3-tag-een-mm-form col-xs-12 nop">

    <?php
    $form = ActiveForm::begin([
            'options' => [
                'id' => 'een-tag-s3-tag-een-mm_'.((isset($fid)) ? $fid : 0),
                'data-fid' => (isset($fid)) ? $fid : 0,
                'data-field' => ((isset($dataField)) ? $dataField : ''),
                'data-entity' => ((isset($dataEntity)) ? $dataEntity : ''),
                'class' => ((isset($class)) ? $class : '')
            ]
    ]);
    ?>
    <?php // $form->errorSummary($model, ['class' => 'alert-danger alert fade in']); ?>

    <div class="row">
        <div class="col-xs-12"><h2 class="subtitle-form">Settings</h2>
            <div class="col-md-8 col xs-12">
                <?php
                if (\Yii::$app->getUser()->can('TAG_CREATE')) {
                    $append = ' canInsert';
                } else {
                    $append = NULL;
                }
                ?>
                <?php
                $ids = \arter\amos\een\models\EenTagS3TagEenMm::find()->select('tag_s3_id')->distinct()->column();
                ?>
                <?=
                $form->field($model, 'een_tag_een_id')->widget(Select::classname(),
                    [
                    'data' => ArrayHelper::map(\arter\amos\een\models\EenTagEen::find()
                            ->andWhere(['id' => $model->een_tag_een_id])
                            ->all(), 'id', 'nomeCodice'),
                    'language' => substr(Yii::$app->language, 0, 2),
                    'options' => [
                        'id' => 'EenTagEen0'.$fid,
                        'multiple' => false,
                        'placeholder' => 'Seleziona ...',
                        'class' => 'dynamicCreation'.$append,
                        'data-model' => 'een_tag_een',
                        'data-field' => 'id_een',
                        'data-module' => '',
                        'data-entity' => 'een-tag-een',
                        'data-toggle' => 'tooltip'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true,
                        'disabled' => true,
                    ],
//                        'pluginEvents' => [
//                            "select2:open" => "dynamicInsertOpening"
//                        ]
                ])->label('TAG EEN')
                ?><!-- description string -->
                <?=
                $form->field($model, 'tagsS3')->widget(Select::classname(),
                    [
                    'data' => ArrayHelper::map(\arter\amos\tag\models\Tag::find()
//                            ->andWhere(['or',
//                                ['not in', 'tag.id', $ids],
//                                (empty($model->tagsS3) ? ['>', 'tag.id', 0] : ['tag.id' => $model->tagsS3])
//                            ])
                            ->andWhere(['>', 'tag.lvl', 1])
                            ->andWhere(['tag.root' => 1])
                            ->andWhere(['<>', 'tag.root', 'tag.id'])
                            ->select(['tag.id', 'tag.nome', 'b.nome as nroot'])
                            ->innerJoin('tag as b',
                                'b.lft <= tag.rgt and b.rgt >= tag.lft and b.lvl = 1 and tag.lvl = 2 and b.root = 1')
                            ->asArray()->all(), 'id', 'nome', 'nroot'),
                    'language' => substr(Yii::$app->language, 0, 2),
                    'options' => [
                        'id' => 'Tag0'.$fid,
                        'multiple' => true,
                        'placeholder' => 'Seleziona ...',
                        'class' => 'dynamicCreation'.$append,
                        'data-model' => 'tag',
                        'data-field' => 'id',
                        'data-module' => '',
                        'data-entity' => 'tag',
                        'data-toggle' => 'tooltip'
                    ],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
//                        'pluginEvents' => [
//                            "select2:open" => "dynamicInsertOpening"
//                        ]
                ])->label('TAG S3')
                ?>                        <?php
                if (\Yii::$app->getUser()->can('EENTAGEEN_CREATE')) {
                    $append = ' canInsert';
                } else {
                    $append = NULL;
                }
                ?>

                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?><!-- created_at datetime -->
                <!--                < ?= $form->field($model, 'created_at')->widget(\kartik\datetime\DateTimePicker::classname(), [-->
                <!--                    'options' => ['placeholder' => Yii::t('amoscore', 'Set time')],-->
                <!--                    'pluginOptions' => [-->
                <!--                        'autoclose' => true-->
                <!--                    ]-->
                <!--                ]) ?>-->
                <?= RequiredFieldsTipWidget::widget(); ?><?= CloseSaveButtonWidget::widget(['model' => $model]); ?><?php ActiveForm::end(); ?></div>
            <div class="col-md-4 col xs-12"></div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
