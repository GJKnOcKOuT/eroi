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

use arter\amos\community\utilities\CommunityUtil;
use arter\amos\community\AmosCommunity;
use arter\amos\community\models\CommunityUserMm;

/**
 * @var $model \arter\amos\community\models\CommunityUserMm
 */
?>
<?php

$controller = Yii::$app->controller;
$isActionUpdate = ($controller->action->id == 'update');
$confirm = $isActionUpdate ? [
    'confirm' => \arter\amos\core\module\BaseAmosModule::t('amoscore', '#confirm_exit_without_saving')
] : null;

$view_email_partecipants = false;
if (isset(Yii::$app->getModule('community')->view_email_partecipants)) {
    $view_email_partecipants = Yii::$app->getModule('community')->view_email_partecipants;
}

?>
<div class="member-items">
    <p class="member-item-name">
        <?= \arter\amos\core\helpers\Html::a('<strong>' . $model->user->userProfile->surnameName . '</strong>', ['/admin/user-profile/view', 'id' => $model->user->userProfile->id ], [
            'data' => $confirm
        ])?>
    </p>

    <p class="member-item-role <?= $model->role ?>">
        <?= AmosCommunity::t('amoscommunity', $model->role) ?>
    </p>
    <span class="member-item-status <?= $model->status ?>">
        <?= AmosCommunity::t('amoscommunity', $model->status) ?>
    </span>
    <p>
        <?= ($view_email_partecipants && $checkCM) ? $model->user->email : '' ?>
    </p>
</div>

