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
 * @package    arter\amos\events\views\event-wizard\layouts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\events\AmosEvents;

/**
 * @var string $publishingEntities
 * @var string $recipients
 */
?>

<dl>
    <dt><?= AmosEvents::tHtml('amosevents', 'Published by') ?></dt>
    <dd><?= $publishingEntities ?></dd>
</dl>
<dl>
    <dt><?= AmosEvents::tHtml('amosevents', 'Recipients') ?></dt>
    <dd><?= $recipients ?></dd>
</dl>
