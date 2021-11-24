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
use backend\modules\aster_admin\assets\AsterAdminAsset;
/**
 * @var yii\web\View $this
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 * @var string $tipologiautente
 * @var string $permissionSave
 */

AsterAdminAsset::register($this);

$this->title = $model;
$this->params['breadcrumbs'][] = ['label' => AmosAdmin::t('amosadmin', 'Utenti'), 'url' => ['/admin']];
$this->params['breadcrumbs'][] = ['label' => AmosAdmin::t('amosadmin', 'Elenco'), 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AmosAdmin::t('amosadmin', 'Aggiorna');
?>

<div class="user-profile-update">
    <?= $this->render('_form', [
        'user' => $user,
        'model' => $model,
        'tipologiautente' => $tipologiautente,
        'permissionSave' => $permissionSave,
        'tabActive' => $tabActive
    ]) ?>
</div>
