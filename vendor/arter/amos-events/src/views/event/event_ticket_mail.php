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


/**
 * @var \arter\amos\admin\models\UserProfile $userProfile
 * @var array $companions
 * @var string $downloadTicketsLink
 * @var string $downloadIcsLink
 * @var \arter\amos\events\models\Event $event
 * @var \arter\amos\events\models\EventInvitation $invitation
 */

?>

<p><?= \arter\amos\events\AmosEvents::txt('Gentile {name_surname}', ['name_surname' => $userProfile->getNomeCognome()]) ?>,</p>
<p><?= \arter\amos\events\AmosEvents::txt('Ringraziandoti per la partecipazione, ti consegniamo i biglietti di ingresso a {event_title} che si svolgerà il {event_date} per', ['event_title' => $event->title, 'event_date' => date("d-m-Y H:i:s", strtotime($event->begin_date_hour))]) ?></p>
<p><?= $userProfile->getNomeCognome(); ?></p>
<?php
    foreach($companions as $companion) {
        echo "<p>{$companion['nome']} {$companion['cognome']}</p>";
    }
?>
<br />
<p><a href="<?= $downloadTicketsLink ?>"><?= \arter\amos\events\AmosEvents::txt('Click here to download your tickets'); ?></a></p>
<br />
<p><a href="<?= $downloadIcsLink ?>"><?= \arter\amos\events\AmosEvents::txt('Per scaricare il file calendario (.ics), clicca qui.'); ?></a></p>
<br />
<p><?= $event->description; ?></p>
<br />
<p><?= $event->getFullAddress("<br />") ?></p>
<br />
<p><?= "TERMINI E CONDIZIONI" ?></p>
