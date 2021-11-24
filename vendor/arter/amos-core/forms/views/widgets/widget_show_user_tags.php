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

use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;

/**
 * @var \arter\amos\tag\models\Tag $root
 * @var \yii\base\View $this
 * @var array $allRootTags
 * @var array $allTags
 */
?>

<?php if (!count($allRootTags)): ?>
    <h3><?= BaseAmosModule::t('amoscore', '#NO_INTEREST_AREA_TAGS'); ?></h3>
<?php else: ?>
    <?php foreach ($allRootTags as $rootId => $root): ?>
        <h3 class="tags-title"><?= $root['el'] ?></h3>
        <ul class="taglist">
            <?php foreach ($allTags as $tag): ?>
                <?php //se ci sono i dati minimi per il confronto del tag ?>
                <?php if (isset($tag['root'])): ?>
                    <?php //se corrisponde la root ?>
                    <?php if ($rootId == $tag['root']): ?>
                        <li class="tag-item">
                            <div>
                                <?= AmosIcons::show('label') ?>
                                <span class="bold uppercase tag-label"><?= $tag['nome'] ?></span>
                                <?php if ($tag['path']): ?>
                                    <p class="m-t-15">
                                        <small class="italic"><?= $tag['path'] ?></small>
                                    </p>
                                <?php endif; ?>
                            </div>
                        </li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        </ul>
        <div class="clearfix"></div>
    <?php endforeach; ?>
<?php endif; ?>
<div class="clearfix"></div>
