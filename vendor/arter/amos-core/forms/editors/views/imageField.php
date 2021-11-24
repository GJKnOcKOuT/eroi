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
 * @package    arter\amos\core\forms\editors\assets\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\icons\AmosIcons;
?>
<div class="fileinput fileinput-new" data-provides="fileinput">
 <div class="fileinput-new thumbnail">
  <?=$thumbnail;?>
 </div>
 <div class="fileinput-preview fileinput-exists thumbnail"></div>
 <div class="container-btn">
  <span class="btn btn-file btn-block nom no-border-radius nop">

   <!-- new image -->
   <span class="fileinput-new btn btn-navigation-primary-inverse btn-upload">
    <?= AmosIcons::show('upload', ['id' => 'bk-btnImport-new']) ?>
   </span>

   <!-- uploading image -->
   <span class="fileinput-exists btn btn-navigation-primary-inverse btn-upload">
    <?= AmosIcons::show('upload', ['id' => 'bk-btnImport-upl']) ?>
   </span>
   <?=$field;?>
   <a href="#" class="btn btn-action-secondary btn-block fileinput-exists" data-dismiss="fileinput" title="delete image">
    <?= AmosIcons::show('delete') ?>
   </a>

  </span>
 </div>
</div>