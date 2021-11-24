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
 * @var arter\amos\cwh\models\CwhRegolePubblicazione $model
 */

$this->title = AmosCwh::t('amoscwh', 'Aggiorna {modelClass}: ', [
        'modelClass' => 'Regole Pubblicazione',
    ]) . ' ' . $model;
$this->params['breadcrumbs'][] = ['label' => AmosCwh::t('amoscwh', 'Regole Pubblicazione'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = AmosCwh::t('amoscwh', 'Aggiorna');
?>
<div class="cwh-regole-pubblicazione-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
