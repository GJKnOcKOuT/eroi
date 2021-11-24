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

/**
 * @var \arter\amos\events\models\Event $event
 * @var \arter\amos\core\user\User $user
 * @var \arter\amos\admin\models\UserProfile $profile
 * @var string $urlYes
 * @var string $urlNo
 */
?>

<h2><?= $event->title ?></h2>
<p><?= $event->summary ?></p>

<p>Gentile <?= $profile->getNomeCognome() ?>, sei stato invitato a questo evento, desideri partecipare?</p>

<a href="<?= $urlYes ?>">Si, mi iscrivo</a>
