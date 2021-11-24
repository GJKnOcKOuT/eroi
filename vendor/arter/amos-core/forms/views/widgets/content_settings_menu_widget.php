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
 * @var boolean $atLeastOneElement
 * @var array $buttons
 * @var string $mainDivClasses
 */

?>
<div class="btn-group">
    <div class="<?= $mainDivClasses ?> content-settings-menu" data-toggle="dropdown" href="" aria-expanded="true"
         title="<?= BaseAmosModule::t('amoscore', '#content_settings_menu_label') ?>">
        <?= AmosIcons::show('settings', ['class' => 'pull-left']) ?>
        <?= AmosIcons::show('chevron-down', ['class' => 'pull-right']) ?>
        <span class="sr-only"><?= BaseAmosModule::t('amoscore', '#content_settings_menu_label') ?></span>
    </div>
    <ul class="dropdown-menu pull-right">
        <?php foreach ($buttons as $button): ?>
            <li><?= $button ?></li>
        <?php endforeach; ?>
    </ul>
</div>

