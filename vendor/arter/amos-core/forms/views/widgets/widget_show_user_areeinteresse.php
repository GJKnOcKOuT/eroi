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
 * @package    arter\amos\core\forms\views\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var \arter\amos\tag\models\Tag $root
 * @var \yii\base\View $this
 */
?>

<?php
foreach ($allRootTags as $root){
    $classname = $root['classname'];
    ?>
    <h3><?= $root['label'] ?></h3>
    <?php
    foreach($root['trees'] as $root_tree) {
        //dati del nodo
        $label_root_tree = $root_tree['nome'];
        $id_root_tree = $root_tree['root'];

        $label_print = false;
        ?>
        <ul class="taglist">
            <?php
            foreach ($allTags as $tag){
                //se ci sono i dati minimi per il confronto del tag
                if (isset($tag['root']) && isset($tag['interest_classname'])){
                    //se corrispondono root e contesto
                    if ($id_root_tree == $tag['root'] && $classname == $tag['interest_classname']){
                        if(!$label_print){
                            ?>
                            <h4><?= $label_root_tree ?></h4>
                            <?php
                            $label_print = true;
                        }
                        ?>
                        <li class="tag-item">
                            <div>
                                <p class="bold uppercase tag-label"><?= $tag['nome'] ?></p>
                                <?php if(!($tag['path'] == NULL)): ?>
                                    <span><small class="italic"><?= $tag['path'] ?></small></span>
                                <?php endif; ?>
                            </div>
                        </li>
                        <?php
                    }
                }
            }
            ?>
        </ul>
        <?php
    }
}
?>
