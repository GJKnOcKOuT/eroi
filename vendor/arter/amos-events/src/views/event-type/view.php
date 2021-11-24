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
 * @package    arter\amos\events\views\event-type
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\CloseButtonWidget;
use arter\amos\events\AmosEvents;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var arter\amos\events\models\EventType $model
 */

$this->title = strip_tags($model->title);
$this->params['breadcrumbs'][] = ['label' => AmosEvents::t('amosevents', 'Event Types'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-type-view">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'description:html',
            'color',
        ],
    ]) ?>
</div>

<?= CloseButtonWidget::widget([
    'title' => AmosEvents::t('amosevents', 'Close'),
    'layoutClass' => 'pull-right'
]) ?>
