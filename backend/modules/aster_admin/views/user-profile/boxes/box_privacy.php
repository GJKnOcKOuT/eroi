<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\admin\AmosAdmin;
use arter\amos\admin\base\ConfigurationManager;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 */
/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;
?>

<section class="section-data">
    <?php if ($adminModule->confManager->isVisibleField('privacy', ConfigurationManager::VIEW_TYPE_FORM)): ?>
        <div class="row">
            <div class="col-xs-12">
                <?php $model->privacy = 1; ?>
                <?=
                $form->field($model, 'privacy', ['options' => ['style' => 'display:none;']])->hiddenInput()->label(false)
                ?>
                <a href="/site/privacy" target="blank">Visualizza il documento della privacy</a>
            </div>
            <!--            <div class="col-xs-4 m-t-20">-->
            <!--                <a href='/site/privacy' target='_blank'>  < ?=AmosAdmin::t('amosadmin','Visualizza il documento della privacy')?></a>-->
            <!--            </div>-->
        </div>
    <?php endif; ?>
</section>

