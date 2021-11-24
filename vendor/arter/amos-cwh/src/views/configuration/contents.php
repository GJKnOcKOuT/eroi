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


use arter\amos\cwh\AmosCwh;

/**
 *
 * @var $this \yii\web\View
 * @var $Content \arter\amos\cwh\models\CwhConfigContents
 */

$this->title = AmosCwh::t('wizard', 'Configurazione {contents} del progetto {appName}', [
    'appName' => Yii::$app->name,
    'contents' => $Content->label
]);

\arter\amos\layout\assets\SpinnerWaitAsset::register($this);

$js = <<<JS
$('form').on('submit', function(event) {
  $('.loading').show();
});
JS;

$this->registerJs($js);

?>

    <?php
    \yii\bootstrap\Alert::begin([
        'closeButton' => false,
        'options' => [
            'class' => 'alert alert-info',
        ],
    ]);
    ?>
    <p>
        <?= AmosCwh::t('wizard', 'Benvenuto nella configurazione di <strong>{contents}</strong>', [
            'contents' => $Content->label
        ]) ?>
    </p>
    <?php
    \yii\bootstrap\Alert::end();
    ?>

    <div class="loading" id="loader" hidden></div>

    <?php $form = \arter\amos\core\forms\ActiveForm::begin() ?>
    <div class="col-sm-6">
        <?= $form->field($Content, 'label') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($Content, 'tablename') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($Content, 'classname') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($Content, 'status_attribute')->widget(\arter\amos\core\forms\editors\Select::className(), ['data' => $Content->modelAttributes]) ?>
    </div>
    <?php if (!empty($Content->statuses)): ?>
        <div class="col-sm-6">
            <?= $form->field($Content, 'status_value')->radioList($Content->statuses) ?>
        </div>
    <?php endif; ?>
    <hr/>
    <div class="col-sm-12 ">
        <?= \arter\amos\core\forms\CloseSaveButtonWidget::widget([
            'model' => $Content,
            'urlClose' => '/cwh/configuration/wizard'
        ])
        ?>
    </div>
    <?php \arter\amos\core\forms\ActiveForm::end() ?>
