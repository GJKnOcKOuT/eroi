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
 * @package    arter\amos\ticket\widgets\graphics\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\ticket\widgets\graphics\WidgetGraphicAssistance;
use yii\data\ActiveDataProvider;

/**
 * @var yii\web\View $this
 * @var WidgetGraphicAssistance $widget
 * @var ActiveDataProvider $waitingTicketsList
 * @var ActiveDataProvider $inProgressTicketsList
 * @var ActiveDataProvider $closedTicketsList
 */

echo $this->render('fullsize/assistance_widget', [
    'widget' => $widget,
    'waitingTicketsList' => $waitingTicketsList,
    'inProgressTicketsList' => $inProgressTicketsList,
    'closedTicketsList' => $closedTicketsList,
]);
