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

use \arter\amos\documenti\AmosDocumenti;
?>
<script id="documents-explorer-rename-folder-modal" type="text/template">
    <div id="documents-explorer-rename-folder-modal-content" class="modal modal-document-explorer">
        <div class="row">
            <div class="col-xs-12">
                <h2><?= AmosDocumenti::t('amosdocumenti', 'Rinomina Cartella'); ?></h2>
                <input id="documents-explorer-rename-folder-name" class="form-control" maxlength="255" type="text">
                <div id="form-actions" class="bk-btnFormContainer">
                    <button class="btn btn-navigation-primary" id="documents-explorer-rename-folder-modal-save"><?= AmosDocumenti::t('amosdocumenti', 'Salva'); ?></button>
                    <a class="btn btn-secondary undo-edit" id="documents-explorer-rename-folder-modal-close" rel="modal:close"><?= AmosDocumenti::t('amosdocumenti', 'Annulla'); ?></a>
                </div>
                <div class="errors">
                </div>
            </div>
        </div>
    </div>
</script>