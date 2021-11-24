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
 * @package    arter\amos\tag\widgets\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\icons\AmosIcons;
use arter\amos\tag\AmosTag;

/**
 * @var \arter\amos\tag\models\Tag $root
 * @var \arter\amos\tag\models\Tag[] $tags
 * @var \yii\base\View $this
 */
?>

<h3 class="tags-title"><?= $root->nome ?></h3>
<?php if(!count($tags)) : ?>
    <?= AmosTag::t('amostag', '#no_tag_selected') ?>
<?php else: ?>
    <ul class="taglist">
        <?php foreach ($tags as $tag) : ?>
            <li class="tag-item">
                <div>
                    <?= AmosIcons::show('label') ?>
                    <span class="bold uppercase tag-label"><?= $tag->nome ?></span>
                    <?php
                    if ($tag->lvl > 1) {
                        $parent = $tag->parents(1)->one();
                        ?>
                        <p class="m-t-15">
                            <small class="italic"><?= $parent->nome ?></small>
                        </p>
                        <?php
                    }
                    ?>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
<div class="clearfix"></div>

