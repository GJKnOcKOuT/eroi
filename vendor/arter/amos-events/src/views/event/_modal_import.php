<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @licence GPLv3
 * @licence https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package amos-invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use \yii\bootstrap\Modal;
use \arter\amos\core\helpers\Html;
use \kartik\widgets\FileInput;
use \yii\base\InvalidConfigException;
use arter\amos\core\forms\ActiveForm;

$linkDownloadAsset = '/events/event/download-import-file-example';
if (!$model->isNewRecord) {
    $modelid = $model->id;

    $js = <<<JS
    $('#submitImport').click(function(){
        $('#form-import-seats')
        .attr('action','/events/event/import-seats?id='+$modelid)
        .submit();
    });
JS;

    $this->registerJs($js);
}


Modal::begin([
    'header' => '<h2>' . Yii::t('amosevents', 'Importa posti') . '</h2>',
    'size' => Modal::SIZE_LARGE,
    'id' => 'modalImport',
]);
$form = ActiveForm::begin([
    'action' => '/events/event/import-seats?id=' . $model->id,
    'id' => 'form-import-seats',
    'options' => [
        'enctype' => 'multipart/form-data'
    ]
]);


$linkDownload = Html::a(Yii::t('amosevents', 'qui'), $linkDownloadAsset);
?>
    <div class="col-xs-12">
        <?php
        echo Yii::t('amosevents', "L'importazione delle risposte può essere fatta solo utilizzando il file predisposto. Segui i seguenti passi:");
        echo '<ol>';
        echo '<li>' . Yii::t('amosevents', 'scarica il file facendo click {linkdownload} e salvalo.', ['linkdownload' => $linkDownload]) . '</li>';
        echo '</ol>';

        echo '<label class="control-label">' . Yii::t('amosevents', 'Carica il file') . '</label>';
        echo FileInput::widget([
            'name' => 'import-file',
            'pluginOptions' => [
                'showPreview' => false,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false
            ]
        ]); ?>
    </div>
    <br>
    <div class="col-xs-12 m-t-10">
        <?php echo Html::button(
            Yii::t('amosevents', 'Import'),
            [
                'class' => 'btn btn-primary pull-right',
                'value' => 'import',
                'type' => 'submit',
                'name' => 'submit-import',
                'id' => 'submitImport'
            ]
        ); ?>
    </div>
<?php
Html::hiddenInput('submit-import', 'import');

ActiveForm::end();
Modal::end();

