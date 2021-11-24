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

//use arter\amos\core\forms\InteractionMenuWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\module\BaseAmosModule;

/**
 * @var string $contentCreatorAvatar Avatar of the content creator.
 * @var string $contentCreatorNameSurname Name and surname of the content creator.
 * @var bool $hideInteractionMenu If true set the class to hide the interaction menu.
 * @var array $interactionMenuButtons Sets the interaction menu buttons.
 * @var array $interactionMenuButtonsHide Sets the interaction menu buttons to hide.
 * @var string $publicatonDate Publication date of the content.
 * @var string $customContent Custom content.
 * @var \arter\amos\core\forms\ItemAndCardHeaderWidget $widget
 */

?>

<div class="post-header col-xs-12 nop">
    <div class="post-header-avatar pull-left">
        <?= $contentCreatorAvatar ?>
    </div>
    <p class="creator"><?= $widget->getCreator($contentCreatorNameSurname) ?></p>
    <?php if (isset($contentPrevalentPartnership) && $contentPrevalentPartnership) : ?>
        <p class="card-prevalent-partnership"><i>(<?= $contentPrevalentPartnership ?>)</i></p>
    <?php endif; ?>
    <?php if (isset($contentCreatorTargets) && $contentCreatorTargets) : ?>
        <p class="card-creator-targets"><strong><?= $contentCreatorTargets ?></strong></p>
    <?php endif; ?>
    <?php if (isset($customContent) && $customContent) : ?>
        <div class="custom-content"><?= $customContent; ?></div>
    <?php endif; ?>
    <?php if ($publicatonDate): ?>
        <p class="publication-date"><?= BaseAmosModule::t('amoscore', 'Pubblicato il') ?> <?= $publicatonDate ?></p>
    <?php endif; ?>
    <?php
    //    echo InteractionMenuWidget::widget([
    //        'hideInteractionMenu' => $hideInteractionMenu,
    //        'interactionMenuButtons' => $interactionMenuButtons,
    //        'interactionMenuButtonsHide' => $interactionMenuButtonsHide,
    //        'model' => $model
    //    ]);
    ?>
</div>
