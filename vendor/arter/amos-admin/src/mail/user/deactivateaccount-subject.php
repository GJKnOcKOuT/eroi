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
 * @package    arter\amos\admin\mail\user
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\utility\UserProfileUtility;

/**
 * @var \arter\amos\admin\models\UserProfile $profile
 */

?>

<?= UserProfileUtility::generateDeactivateSubject($profile) ?>
