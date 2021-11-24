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

use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;

/**
 * @var \arter\amos\core\widget\WidgetGraphic $widget The widget view where this is applied
 * @var string $tClassName Complete classname of module of the graphic widget.
 * @var string $actionRoute Route to controller action.
 * @var array $options Array of options to be applied at create button.
 * @var string $permissionSave Permission to check to view the create new button.
 * @var string $toRefreshSectionId Id of the section to refresh.
 */

$userCanDirectlyCreate = (!isset($permissionSave) || !is_string($permissionSave) || !Yii::$app->user->can($permissionSave));

?>
<div class="manage col-xs-2 nop pull-right">
    <div class="dropdown">
        <a class="manage-menu" data-toggle="dropdown" href="" aria-expanded="true" title="impostazioni widget">
            <?= AmosIcons::show('settings', ['class' => 'pull-left']) ?> <?= AmosIcons::show('chevron-down', ['class' => 'pull-right']) ?><?= '<span class="sr-only">' . Yii::t('amoscore', 'Manage Menu') . '</span>' ?>
        </a>
        <ul class="dropdown-menu pull-right">
            <li>
                <a href="javascript:void(0);" class="graphic-widget-refresh-btn" data-btnrefresh="<?= $toRefreshSectionId ?>" title="refresh">
                    <?= AmosIcons::show("rotate-left") ?><?= Yii::t('amoscore', 'Refresh') ?>
                </a>
            </li>
            <?php if (!is_null(Yii::$app->getModule('faq'))): ?>
                <li>
                    <a href="/faq/faq/index?FaqSearch[faq_widgets_id]=<?= $widget::className() ?>" title="faq">
                        <?= AmosIcons::show("help-outline") ?>  <?= $tClassName::t('app', 'Faq') ?>
                        <span class="sr-only"><?php echo Yii::t('amoscore', 'Faq') ?></span>
                    </a>
                </li>
            <?php endif; ?>
            <li>
                <?= Html::a(AmosIcons::show("plus") . BaseAmosModule::t('amoscore', 'Crea nuovo'), $actionRoute, ['title' => BaseAmosModule::t('amoscore', 'Crea nuovo')], $userCanDirectlyCreate); ?>
            </li>
        </ul>
    </div>
</div>

