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
 * @package    arter\amos\events\views\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\events\AmosEvents;

/**
 * @var \arter\amos\events\models\Event $event
 * @var \arter\amos\core\user\User $user
 */

?>

<h2>
    <?= AmosEvents::t('amosevents', 'Has been requested the validation for event'); ?>
</h2>
<?= AmosEvents::t('amosevents', 'Event type') . ': ' . !is_null($event->eventType) ? $event->eventType->title : '-'. '<br>'; ?>
<?= AmosEvents::t('amosevents', 'Event title') . ': ' . $event->title . '<br>'; ?>
<?= AmosEvents::t('amosevents', 'Event summary') . ': ' . $event->summary . '<br>'; ?>
<?= AmosEvents::t('amosevents', 'Published by') . ': ' . $user->userProfile->getNomeCognome(); ?>
