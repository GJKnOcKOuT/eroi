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
 * @package    arter\amos\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\events\AmosEvents;

/**
 * @var yii\web\View $this
 * @var arter\amos\events\models\EventType $model
 */

$this->title = AmosEvents::t('amosevents', 'Update');
$this->params['breadcrumbs'][] = ['label' => AmosEvents::t('amosevents', 'Event Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => strip_tags($model->title), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-type-update">
    <?= $this->render('_form', [
        'model' => $model,
        'fid' => NULL,
        'dataField' => NULL,
        'dataEntity' => NULL,
    ]) ?>
</div>
