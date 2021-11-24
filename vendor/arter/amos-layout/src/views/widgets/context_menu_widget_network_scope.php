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
 * @package    arter\amos\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var boolean $atLeastOnePermission
 * @var array $buttons
 * @var string $mainDivClasses
 */

use arter\amos\core\icons\AmosIcons;

?>
<?php if ($atLeastOnePermission): ?>
    <div class="manage-network-scope <?= $mainDivClasses ?>">
        <div class="dropdown">
            <a class="manage-menu" data-toggle="dropdown" href="" aria-expanded="true"
               title="<?= Yii::t('amoscore', 'Menu contestuale') ?>">
                <?= AmosIcons::show('settings', [], AmosIcons::IC) ?>
                <span class="sr-only"><?= Yii::t('amoscore', 'Menu contestuale') ?></span>
            </a>
            <ul class="dropdown-menu pull-right">
                <?php foreach ($buttons as $button): ?>
                    <li><?= $button ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
