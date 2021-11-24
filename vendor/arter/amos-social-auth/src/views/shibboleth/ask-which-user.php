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
 * @package    arter\amos\socialauth\views\shibboleth
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\models\UserProfile;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\editors\Select;
use arter\amos\socialauth\Module;
use arter\amos\socialauth\utility\SocialAuthUtility;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var array $userDatas
 * @var UserProfile[] $usersByCF
 */

$title = Module::t('amossocialauth', 'spid_signup_welcome', ['nome' => $userDatas['nome'], 'cognome' => $userDatas['cognome']]);
$this->title = $title

?>

<div class="loginContainer">
    <div class="body col-xs-12">
        <h2 class="title-login"><?= $title ?></h2>
        <h3 class="subtitle-login"><?= Module::t('amossocialauth', '#spid_login_multi_cf_subtitle', ['cf' => $userDatas['codiceFiscale']]) ?></h3>
        <?php
        $form = ActiveForm::begin([
            'action' => Yii::$app->controller->action->id,
            'method' => 'post',
            'options' => [
                'class' => 'default-form'
            ]
        ]);
        ?>
        <div class="m-b-20">
            <?= Select::widget([
                'name' => 'user_by_fiscal_code',
                'data' => SocialAuthUtility::makeUsersByCFReadyForSelect($usersByCF),
                'options' => [
                    'multiple' => false,
                    'placeholder' => Module::t('amoscore', 'Select/Choose') . '...',
                ],
                'class' => 'form-control',
                'id' => 'user_by_fiscal_code_id',
            ]); ?>
        </div>
        <div class="col-xs-12 text-center">
            <?= Html::submitButton(Module::t('amossocialauth', 'spid_signup_already_registered_btn'), ['class' => 'btn btn-administration-primary']) ?>
        </div>
    </div>
    <div class="col-lg-12 col-sm-12 col-xs-12 footer-link text-center">
    </div>
    <?php ActiveForm::end(); ?>
</div>
