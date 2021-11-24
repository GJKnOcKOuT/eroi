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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;

// parse parent key
if ($noNodesMessage) {
    $parentKey = '';
} elseif (empty($parentKey)) {
    $parent = $node->parents(1)->one();
    $parentKey = empty($parent) ? '' : Html::getAttributeValue($parent, $keyAttribute);
}
?>

<div class="row">
    <?php if($node->isRoot() || strpos($parentKey, "ROOT") !== false){ ?>
    <div class="col-sm-6">
        <?php echo $form->field($node, 'limit_selected_tag')->textInput(); ?>
    </div>
    <?php } ?>
    <div class="col-sm-6">
        <?php echo $form->field($node, 'codice')->textInput(); ?>
    </div>
    <div class="col-sm-12">
        <?php echo $form->field($node, 'descrizione')->textarea(['rows' => 6]); ?>
    </div>
</div>
