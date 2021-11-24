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
 * @package    arter-report
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
?>

<h3><?=\arter\amos\report\AmosReport::t('amosreport', 'La segnalazione è stata inviata correttamente. ');?></h3>
<p class="pull-right">
    <?php
    $button = '<a href="' . $href . '" class="btn btn-primary" id="closeModal" title="'.\arter\amos\report\AmosReport::t("amosreport", "La segnalazione è stata inviata correttamente.").'">' .\arter\amos\report\AmosReport::t("amosreport", "Chiudi."). '</a>';
    echo $button;
    ?>
</p>
