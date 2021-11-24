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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var yii\web\View $this
 * @var arter\amos\discussioni\models\DiscussioniCommenti $model
 */

use arter\amos\discussioni\AmosDiscussioni;

$this->title = AmosDiscussioni::t('amosdiscussioni', 'Update {modelClass}: ', [
        'modelClass' => 'Discussioni Commenti',
    ]) . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => AmosDiscussioni::t('amosdiscussioni', 'Discussioni Commentis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = AmosDiscussioni::t('amosdiscussioni', 'Update');
?>
<div class="discussioni-commenti-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
