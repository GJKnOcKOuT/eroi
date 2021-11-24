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
 * @package    arter\amos\ticket\views\ticket
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\ticket\AmosTicket;

/**
 * @var yii\web\View $this
 * @var arter\amos\ticket\models\Ticket $model
 * @var arter\amos\ticket\models\Ticket $model_old_ticket
 */

$this->title = AmosTicket::t('amosticket', 'Inoltra ad altra categoria');
$this->params['breadcrumbs'][] = ['label' => Yii::t('cruds', 'Ticket'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ticket-change_categoria">
    <?= $this->render('_form_change_categoria', [
        'model' => $model,
        'model_old_ticket' => $model_old_ticket
    ]) ?>
</div>
