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
<script id="documents-explorer-breadcrumb" type="text/template">
    <div class="col-xs-12 nop">
        <div class="col-xs-12 explorer-breadcrumb">
            <span><?= AmosDocumenti::t('amosdocumenti', 'Sei in: ') . ' '; ?></span>
            {{#links}}
            <span class="{{classes}}" data-parent-id="{{model-id}}" data-scope-id="{{scope-id}}">
                {{name}}
            </span>
            {{#isNotLast}}<span> > </span>{{/isNotLast}}
            {{/links}}
        </div>
    </div>
</script>