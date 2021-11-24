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
 * @package    arter\amos\ticket\widgets\graphics\views\fullsize
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\ticket\AmosTicket;
use arter\amos\ticket\models\Ticket;
use arter\amos\ticket\widgets\graphics\WidgetGraphicAssistance;

/**
 * @var yii\web\View $this
 * @var WidgetGraphicAssistance $widget
 * @var Ticket $ticket
 * @var string $listContainerClass
 */

?>

<p><span class="<?= $listContainerClass; ?>"><?= '#'. $ticket->id; ?></span>
    <span><?= Yii::$app->getFormatter()->asDate($ticket->created_at) . ' ' . AmosTicket::t('amosticket', '#from') . ' ' . $ticket->createdUserProfile->nomeCognome; ?>
</p>
<p><?= Html::a($ticket->titolo, $ticket->getFullViewUrl()); ?></p>
