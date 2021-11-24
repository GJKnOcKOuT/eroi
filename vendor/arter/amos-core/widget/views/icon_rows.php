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
 * @package    arter\amos\core\widget\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var $this \yii\web\View
 * @var $widget \arter\amos\core\widget\WidgetIcon
 * @var $asset \yii\web\AssetBundle
 */
$classSpanStr = implode(' ', $widget->classSpan);
$classSpanLi = implode(' ', $widget->classLi);
$classSpanA = implode(' ', $widget->classA);
$className = $widget::className();
$userAgent = (strpos($_SERVER['HTTP_USER_AGENT'], 'Trident/') > -1 || strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE')) ? 'ie' : '';

$url = is_array($widget->url) ? \yii\helpers\Url::to($widget->url) : $widget->url;
$target = ((strlen($widget->targetUrl) > 0) ? 'target="' . $widget->targetUrl . '" ' : '');
$dataModule = $widget->moduleName;

use arter\amos\core\icons\AmosIcons;
?>

<div class="square-box" data-code="<?= $className ?>">
    <div class="square-content item-widget" data-code="<?= $className ?>">
        <?php if (strlen($url)): ?>
            <a data-module="<?= $dataModule ?>" class="<?= $classSpanA ?> dashboard-menu-item <?= ($widget->active == true ? 'active' : '')?>" href="<?= $url ?>"
           <?= $target ?>title="<?= $widget->description ?>" role="menuitem" class="sortableOpt1" <?= $widget->dataPjaxZero ?> <?= $widget->attributes ?>>
        <?php else: ?>
            <div class="dashboard-menu-item">
        <?php endif; ?>

        <?php if (strlen($url) && ($widget->targetUrl == '_blank')): ?>
            <span class="sr-only"><?= Yii::t('amoscore', 'Questo link verrà aperto in una nuova pagina') ?></span>
        <?php endif; ?>
        <span class="badge"><?= $widget->bulletCount ? $widget->bulletCount : '' ?></span>
        <?php if (!(strpos($classSpanA, 'open-modal-dashboard') === false)) {
            echo AmosIcons::show('modale', ['class' => 'icon-open-modal'], AmosIcons::IC);
        } ?>
        <span class="<?= $classSpanStr ?>">
            <?= \arter\amos\core\icons\AmosIcons::show($widget->icon, [], $widget->iconFramework) ?>
            <!--span class="svg-container">
                <svg title="< ?= $widget->description ?>" role="img" class="svg-content">
                  <use xlink:href="< ?= $asset->baseUrl ?>/svg/icone< ?= vv ?>.svg#< ?= $widget->icon ?>"></use>
                </svg>
            </span-->
        <span class="icon-dashboard-name pluginName"><?= $widget->label ?></span>

        <?php if (strlen($url)): ?>
            </a>
        <?php else: ?>
            </div>
        <?php endif; ?>
    </div>
</div>
