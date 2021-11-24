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
 * @package amos-admin
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\helpers\Html;
use arter\amos\admin\assets\ModuleAdminAsset;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use arter\amos\core\icons\AmosIcons;
use yii\helpers\Url;

ModuleAdminAsset::register(Yii::$app->view);



?>
<?= Html::tag('h2', AmosAdmin::t('amosadmin', '#fullsize_spid'), ['class' => 'title-login']) ?>
<div class="col-sm-6 col-xs-12 nop">
    <?=
    Html::a(
        AmosIcons::show('account-circle') . AmosAdmin::t('amosadmin', '#fullsize_login_spid_text'),
        Url::to('/socialauth/shibboleth/endpoint', 'https'),
        [
            'class' => 'btn btn-spid',
            'title' => AmosAdmin::t('amosadmin', '#fullsize_login_spid_text'),
            //'target' => '_blank'
        ]
    )
    ?>
</div>
<div class="col-xs-12 nop">
    <p class="spid-text"><?= AmosAdmin::t('amosadmin', '#fullsize_login_spid_text_right') ?></p>
</div>
