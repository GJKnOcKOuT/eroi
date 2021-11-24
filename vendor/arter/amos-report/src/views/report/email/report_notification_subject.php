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
 * @package    arter\amos\report\views\report\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\report\AmosReport;

/**
 * @var string $reportCreatorName
 * @var \arter\amos\core\record\Record $contentModel
 */

?>

<?= $reportCreatorName . " " . AmosReport::t('amosreport', "sent a report for the") . " " . AmosReport::t('amosreport', 'content') . " '" . $contentModel . "'"; ?>
