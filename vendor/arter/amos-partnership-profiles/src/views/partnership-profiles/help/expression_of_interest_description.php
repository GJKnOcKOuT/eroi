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
 * @package    arter\amos\partnershipprofiles\views\partnership-profiles\help
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\partnershipprofiles\Module;

$challenge_description = Module::t('amospartnershipprofiles', '#expression_of_interest_challenge');
$facilitator_description = Module::t('amospartnershipprofiles', '#expression_of_interest_facilitator');
?>

<?php if(!empty($challenge_description)): ?>
    <div class="description-challenge">
        <?= $challenge_description ?>
    </div>
<?php endif; ?>
<?php if(!empty($facilitator_description)): ?>
    <div class="description-facilitator">
        <?= $facilitator_description ?>
    </div>
<?php endif; ?>

