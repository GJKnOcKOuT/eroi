<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\core\helpers\Html;
use arter\amos\core\forms\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use arter\amos\core\forms\Tabs;
use arter\amos\core\forms\CloseSaveButtonWidget;
use yii\helpers\Url;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use arter\amos\videoconference\models\Videoconf;

/**
 * @var yii\web\View $this
 * @var arter\amos\videoconference\models\Videoconf $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<?php
$js = <<<JS
    $(".schedule-videoconference").click(function(){
        if($(this).is(':checked')) {
           $('#date-hour-container').show();
        }
        else {
             $('#date-hour-container').hide();
             $('#_date_begin-disp').val('');
             $('#_date_begin').val('');
             $('#_date_end').val('');
             $('#_date_end-disp').val('');
        }
    });
JS;

$this->registerJs($js);

?>
<div class="videoconf-form col-xs-12 nop">

    <?php
    $form = ActiveForm::begin([
        'options' => [
            'id' => 'videoconf_' . ((isset($fid)) ? $fid : 0),
            'data-fid' => (isset($fid)) ? $fid : 0,
            'data-field' => ((isset($dataField)) ? $dataField : ''),
            'data-entity' => ((isset($dataEntity)) ? $dataEntity : ''),
            'class' => ((isset($class)) ? $class : ''),
            'enctype' => 'multipart/form-data' // important
        ]
    ]);
    ?>

    <!--   DETTAGLIO  -->
    <?php $this->beginBlock('dettaglio'); ?>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <?php if($model->isNewRecord || $model->status == Videoconf::STATUS_FUTURE) {?>
    <div class="row">
        <?php if(!$model->sheduledVideoconfCheckBox) {
            $display = 'display:none;';
        }else {
            $model->sheduledVideoconfCheckBox= 1;
            $display = '';
        }?>
        <div class="col-lg-4 col-sm-12">
            <?= $form->field($model, 'sheduledVideoconfCheckBox')->checkbox(['class' => 'schedule-videoconference'])->label(\arter\amos\videoconference\AmosVideoconference::t('amosvideoconference', 'Programma videoconferenza'));?>
        </div>
    </div>
    <div id = "date-hour-container" class="row" style="<?= $display ?>">
        <div class="col-lg-4 col-sm-12">
            <?= $form->field($model, 'begin_date_hour')->widget(DateControl::className(), [
//                    'displayFormat' => 'php:d-M-Y H:i:s',
                'type' => DateControl::FORMAT_DATETIME,
                 'options' => [
                        'id' => '_date_begin'
                 ]
            ]) ?>
        </div>

        <div class="col-lg-4 col-sm-12">
            <?= $form->field($model, 'end_date_hour')->widget(DateControl::className(), [
                'type' => DateControl::FORMAT_DATETIME,
                'options' => [
                    'id' => '_date_end'
                ]
            ]) ?>
        </div>

        <div class="col-lg-4 col-sm-12">
            <?= $form->field($model, 'notification_before_conference')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <?php } ?>

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?= $form->field($model, 'description')->widget(yii\redactor\widgets\Redactor::className(), [
                'clientOptions' => [
                    'lang' => 'it',
                    'plugins' => ['clips', 'fontcolor', 'imagemanager'],
                ],
            ]);
            ?>
        </div>
    </div>
    <?php $this->endBlock('dettaglio'); ?>


    <!--   PARTECIPANTI  -->
    <?php $this->beginBlock('partecipanti'); ?>
    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <?php
            /**
             * @see https://github.com/softark/yii2-dual-listbox or https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox
             */
            echo \softark\duallistbox\DualListbox::widget([
                'model' => $model_partecipanti,
                'name' => 'ids',
                'attribute' => 'ids',
                'items' => $partecipanti,
                'options' => [
                    'multiple' => true,
                    'size' => 25,
                ],
                'clientOptions' => [
                    'nonSelectedListLabel' => \Yii::t('app', 'utenti'),
                    'selectedListLabel' => \Yii::t('app', 'utenti partecipanti'),
                    'moveOnSelect' => true,
                    'moveAllLabel' => \Yii::t('app', 'aggiungi tutti'),
                    'removeAllLabel' => \Yii::t('app', 'rimuovi tutti'),
                    'filterTextClear' => \Yii::t('app', 'mostra tutti'),
                    'filterPlaceHolder' => \Yii::t('app', 'filtro'),
                    'infoTextFiltered' => '<span class="label label-warning">' . \Yii::t('app', 'filtro') . '</span> {0} ' . \Yii::t('app', 'di') . ' {1}',
                    'infoText' => \Yii::t('app', 'elementi totali') . ' {0}',
                    'infoTextEmpty' => \Yii::t('app', 'nessun elemento'),
                ],
            ]);
            ?>

        </div>
    </div>
    <?php $this->endBlock('partecipanti'); ?>

    <?php
    $itemsTab[] = [
        'label' => Yii::t('cruds', 'dettaglio'),
        'content' => $this->blocks['dettaglio'],
    ];
    $itemsTab[] = [
        'label' => Yii::t('cruds', 'partecipanti'),
        'content' => $this->blocks['partecipanti'],
    ];
    ?>

    <?=
    Tabs::widget(
        [
            'encodeLabels' => false,
            'items' => $itemsTab
        ]
    );
    ?>
    <?= CloseSaveButtonWidget::widget(['model' => $model]); ?>
    <?php ActiveForm::end(); ?>
</div>


