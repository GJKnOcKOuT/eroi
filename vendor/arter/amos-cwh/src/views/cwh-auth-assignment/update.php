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
 * @var yii\web\View $this
 * @var arter\amos\cwh\models\CwhConfig $model
 * @var \yii\rbac\Permission[] $authItems
 */

$this->title = AmosCwh::t('amoscwh', 'Aggiorna {modelClass}: ', [
        'modelClass' => 'Cwh Domini',
    ]) . ' ' . $model;
$this->params['breadcrumbs'][] = ['label' => AmosCwh::t('amoscwh', 'Cwh Domini'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = AmosCwh::t('amoscwh', 'Aggiorna');
?>
<div class="cwh-config-update">

    <?= $this->render('_form', [
        'model' => $model,
        'authItems' => $authItems,
    ]) ?>

</div>
