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
 * @package    arter\amos\bestpratices\views\best-pratice\help
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\partnershipprofiles\Module;

$label = Module::t('amospartnershipprofiles', '#yours_interest_create_challenges');

if(!empty($label)) : ?>
    <div class="yours-interest-create-challenges">
        <?= $label ?>
    </div>
<?php endif; ?>
