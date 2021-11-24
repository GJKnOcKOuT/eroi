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
 * @package    arter\amos\community\widgets\graphics\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;
use arter\amos\core\helpers\Html;
use yii\web\View;

/**
 * @var View $this
 * @var \arter\amos\community\widgets\graphics\WidgetGraphicsCommunityReports $widget
 * @var array $downloadConfs
 */

$index = 0;

?>

<div class="box-widget">
    <div class="box-widget-toolbar row nom">
        <h2 class="box-widget-title col-xs-10 nop"><?= AmosCommunity::t('amoscommunity', 'Reports') ?></h2>
    </div>
    <section>
        <div role="listbox">
            <div class="list-items">
                <div class="widget-listbox-option row list-items" role="option">
                    <?php foreach ($downloadConfs as $downloadConf): ?>
                        <?php
                        if (isset($downloadConf['hideThis']) && $downloadConf['hideThis']) {
                            continue;
                        }
                        ?>
                        <?php if ($index != 0): ?>
                            <hr>
                        <?php endif; ?>
                        <?php $index++; ?>
                        <article class="col-xs-12 nop">
                            <div class="container-text col-xs-12 nop">
                                <p class="box-widget-subtitle pull-left"><?= $downloadConf['text']; ?></p>
                                <span class="pull-right">
                                    <?= Html::a(AmosCommunity::t('amoscommunity', 'Download'), $downloadConf['url'], [
                                        'class' => 'btn btn-navigation-primary',
                                        'target' => '_popup',
                                        'title' => AmosCommunity::t('amoscommunity', 'Download')
                                    ]); ?>
                                </span>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </section>
</div>
