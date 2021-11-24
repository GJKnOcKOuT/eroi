<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/** @var \dosamigos\fileupload\FileUpload $this */
/** @var string $input the code for the input */
?>

<span class="btn btn-success fileinput-button">
   <i class="glyphicon glyphicon-plus"></i>
   <span><?= Yii::t('fileupload', 'Select file...') ?></span>
   <!-- The file input field used as target for the file upload widget -->
    <?= $input ?>
</span>
