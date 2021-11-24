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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
\arter\amos\cwh\assets\CwhAsset::register($this);

use arter\amos\cwh\AmosCwh;
?>


<div class='row'>
  <h3 class="subtitle-section-form"><?= AmosCwh::t('amoscwh', '#subtitle_section_form'); ?></h3>
  <div class="col-md-4 col-xs-12">{validatori}</div>
  <div class='col-md-4 col-xs-12'>{previewSign}</div>
  <div class="clearfix"></div>
  <div class="col-md-4 col-xs-12">{destinatari}</div>
  <div class='col-md-4 col-xs-12'>{regolaPubblicazione}</div>
</div>
