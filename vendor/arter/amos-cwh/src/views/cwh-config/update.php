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


/**
 * @var yii\web\View $this
 * @var arter\amos\cwh\models\CwhConfig $model
 */
use arter\amos\cwh\AmosCwh;

$this->title = AmosCwh::t('amoscwh', 'Update {modelClass}: ', [
        'modelClass' => 'Cwh Config',
    ]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => AmosCwh::t('amoscwh', 'Cwh Configs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AmosCwh::t('amoscwh', 'Update');
?>
<div class="cwh-config-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
