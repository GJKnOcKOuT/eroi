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
 * @package    arter\amos\ticket\views\ticket-categorie
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\ticket\AmosTicket;

/**
 * @var yii\web\View $this
 * @var arter\amos\ticket\models\TicketCategorie $model
 */

$this->title = AmosTicket::t('amosticket', 'Crea categoria');
$this->params['breadcrumbs'][] = ['label' => AmosTicket::t('amosticket', 'Assistenza'), 'url' => '/ticket'];
$this->params['breadcrumbs'][] = ['label' => AmosTicket::t('amosticket', 'Categorie'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="ticket-categorie-create">
    <?= $this->render('_form', [
        'model' => $model,
        'model_referenti' => $model_referenti,
        'referenti' => $referenti,
        'community' => $community,
    ]) ?>
</div>
