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


use arter\amos\community\AmosCommunity;
use arter\amos\core\helpers\Html;
use arter\amos\core\module\BaseAmosModule;

/**
 * @var yii\web\View $this
 * @var $model \arter\amos\community\models\CommunityUserMm
 */

$controller = Yii::$app->controller;
$isActionUpdate = ($controller->action->id == 'update');
$confirm = $isActionUpdate ? [
    'confirm' => BaseAmosModule::t('amoscore', '#confirm_exit_without_saving')
] : null;

?>
<div class="member-items">
    <p class="member-item-name">
        <?= Html::a('<strong>' . $model->name . '</strong>', ['/community/community/view', 'id' => $model->id], [
            'data' => $confirm
        ]) ?>
    </p>
    <p class="member-item-role">
        <?= AmosCommunity::t('amoscommunity', $model->communityType->name) ?>
    </p>
    <span class="member-item-status">
         <?= $model->workflowStatus->label ?>
    </span>
</div>
