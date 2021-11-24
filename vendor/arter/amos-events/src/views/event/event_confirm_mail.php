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
 * @var string $communityLink
 * @var string $removeInvitationLink
 * @var string $downloadIcsLink
 * @var \arter\amos\events\models\Event $event
 * @var \arter\amos\events\models\EventInvitation $invitation
 */

?>

<p><?= \arter\amos\events\AmosEvents::txt('Gentile {name_surname}', ['name_surname' => $userProfile->getNomeCognome()]) ?>,</p>
<p><?= \arter\amos\events\AmosEvents::txt(
    'Ti confermiamo l\'iscrizione all\'evento {event_title} che si svolgerà dal {event_date} al {event_end_date}', [
        'event_title' => $event->title,
        'event_date' => Yii::$app->getFormatter()->asDatetime($event->begin_date_hour, 'humanalwaysdatetime'),
        'event_end_date' => Yii::$app->getFormatter()->asDatetime($event->end_date_hour, 'humanalwaysdatetime')
    ]) ?></p>
<p><?= $userProfile->getNomeCognome(); ?></p>
<?php
    foreach($companions as $companion) {
        echo "<p>{$companion['nome']} {$companion['cognome']}</p>";
    }
?>
<br />
<p><?= $event->description; ?></p>
<br />
<p><?= $event->getFullAddress("<br />") ?></p>
<?php if($event->show_community): ?>
<br />
<p><?= \yii\helpers\Html::a(\arter\amos\events\AmosEvents::txt('Se desideri partecipare alla community dell’evento clicca qui: potrai trovare notizie, documenti e altro materiale pubblicato per te'), $communityLink); ?></p>
<?php endif; ?>
<br />
<p><?= \yii\helpers\Html::a(\arter\amos\events\AmosEvents::txt('Se desideri annullare la tua iscrizione all’evento, clicca qui.'), $removeInvitationLink) ?></p>
<p><?= \yii\helpers\Html::a(\arter\amos\events\AmosEvents::txt('Per scaricare il file calendario (.ics), clicca qui.'), $downloadIcsLink )?></p>
