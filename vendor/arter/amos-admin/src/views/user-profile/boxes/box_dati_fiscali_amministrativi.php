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
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\base\ConfigurationManager;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;

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
    <h2>
        <?= AmosIcons::show('case'); ?>
        <?= AmosAdmin::tHtml('amosadmin', 'Dati Fiscali e Amministrativi') ?>
    </h2>
    <!--
    <div class="bk-testoBoxInfo">
        <p>< ?= AmosAdmin::tHtml('amosadmin', "I dati amministrativi consentono la fatturazione e il pagamento delle parcelle, assicurarsi che i dati inseriti siano corretti."); ?></p>
    </div>-->

    <div class="row">
        <?php if ($adminModule->confManager->isVisibleField('codice_fiscale', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <div class="col-lg-6 col-sm-6">
                <?= $form->field($model, 'codice_fiscale')->textInput(['maxlength' => true, 'data-message' => Html::error($model, 'codice_fiscale')]) ?>
            </div>
        <?php endif; ?>
        <?php if ($adminModule->confManager->isVisibleField('partita_iva', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <div class="col-lg-6 col-sm-6">
                <?= $form->field($model, 'partita_iva')->textInput(['maxlength' => true, 'data-message' => Html::error($model, 'partita_iva')]) ?>
            </div>
        <?php endif; ?>
        <?php if ($adminModule->confManager->isVisibleField('iban', ConfigurationManager::VIEW_TYPE_FORM)): ?>
            <div class="col-lg-6 col-sm-6">
                <?= $form->field($model, 'iban')->textInput(['maxlength' => true, 'data-message' => Html::error($model, 'iban')]) ?>
            </div>
        <?php endif; ?>
    </div>
</section>
