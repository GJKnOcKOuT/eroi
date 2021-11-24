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
 * @var $Network \arter\amos\cwh\models\CwhConfigContents
 */

$this->title = AmosCwh::t('wizard', 'Configurazione {network} del progetto {appName}', [
    'appName' => Yii::$app->name,
    'network' => $Network->tablename
]);

?>


<div class="">
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
            'contents' => $Network->tablename
        ]) ?>
    </p>
    <?php
    \yii\bootstrap\Alert::end();
    ?>

</div>
<div class="">
    <?php $form = \arter\amos\core\forms\ActiveForm::begin() ?>

    <div class="col-sm-6">
        <?= $form->field($Network, 'classname') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($Network, 'tablename') ?>
    </div>
    <div class="col-sm-6">
        <?= $form->field($Network, 'visibility') ?>
    </div>
    <div class="col-sm-6">
        <?= AmosCwh::t('amoscwh', '#visibility_hint') ?>
    </div>
<!--    <div class="col-sm-12">-->
<!--        < ?= $form->field($Network, 'raw_sql')->textarea([-->
<!--            'rows' => 12-->
<!--        ]) ?>-->
<!--    </div>-->

    <hr />

    <div class="col-sm-12 ">
        <?= \arter\amos\core\helpers\Html::a(AmosCwh::t('amoscwh', 'Chiudi'),\yii\helpers\Url::previous(), [
            'class' => 'btn btn-secondary pull-left m-t-15',
            'name' => 'close',
        ]) ?>
        <?= \arter\amos\core\forms\CloseSaveButtonWidget::widget([
            'model' => $Network,
            'buttonSaveLabel' => AmosCwh::tHtml('amoscwh', 'Salva'),
            'buttonCloseVisibility' => false,
        ])
        ?>
    </div>

    <?php \arter\amos\core\forms\ActiveForm::end() ?>

</div>