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
 * @package    arter\amos\events\views\event
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\forms\CloseButtonWidget;
use arter\amos\events\AmosEvents;

/**
 * @var yii\web\View $this
 * @var \arter\amos\events\models\Event $event
 */

$this->title = AmosEvents::txt('#event_signup_thankyou_waiting');
$this->params['breadcrumbs'][] = $this->title;

?>

<h3><?= AmosEvents::txt('Grazie di esserti registrato.'); ?></h3>
<h3><?= AmosEvents::txt('#event_signup_thankyou_msg_1'); ?></h3>
<h3><?= AmosEvents::txt('#event_signup_thankyou_msg_2'); ?></h3>
<div class="btnViewContainer pull-left">
    <?= CloseButtonWidget::widget([
        'title' => AmosEvents::t('amosevents', '#go_back_to_event'),
        'layoutClass' => 'pull-left',
        'urlClose' => $event->getFullViewUrl()
    ]); ?>
</div>
