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
 * @package    arter\amos\core\forms\views\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var bool $hideInteractionMenu If true set the class that hide the interaction menu.
 * @var string $interactionMenuButtons The HTML to render the interaction menu buttons.
 */
?>

<div class="interaction-widget<?= ($hideInteractionMenu ? ' hidden' : '') ?>">
    <?= $interactionMenuButtons ?>
</div>