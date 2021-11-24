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
 * @package    arter\amos\slideshow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\icons\AmosIcons;

/*
 * Personalizzare a piacimento la vista
 * $model è il model legato alla tabella del db
 * $buttons sono i tasti del template standard {view}{update}{delete}
 */
?>

<div class="card-container">
    <div class="icon-header grow-pict">
        <a href="#"><img class="img-responsive img-round" src="<?= $model->getAvatarUrl('medium') ?>"
                         alt="<?= $model ?>"></a>
    </div>
    <div class="icon-body">
        <div class="container-title"><h3><a href="#"><?= $model ?></a></h3></div>
        <?php if ($model->getTestoIcon()): ?>
            <p><?= $model->getTestoIcon() ?></p>
        <?php endif; ?>
        <?php if ($model->getTelefonoDefault()): ?>
            <p>
                <?= AmosIcons::show('phone'); ?>
                <span title="<?= $model->getTelefonoDefault() ?>"><?= $model->getTelefonoDefault() ?></span>
            </p>
            <?php
        endif;
        if ($model->getEmailDefault()):
            ?>
            <?= AmosIcons::show('email', ['class' => 'ellipsis-text', 'title' => $model->getEmailDefault()], \Yii::$app->params['icon-framework'], true, 'p', $model->getEmailDefault()); ?>
        <?php endif; ?>
    </div>
    <div class="icon-footer">
        <div class="foot-bar">
            <?php if ($model->getContattiComune()): ?>
                <div class="col-sm-7 col-xs-12 ">
                    <?= $model->getContattiComune() ?>
                </div>
                <div class="col-sm-5 col-xs-12 container-action">
                    <?= $buttons ?>
                </div>
            <?php else: ?>
                <div class="col-xs-12 container-action">
                    <?= $buttons ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="foot-button">
            <button class="btn btn-navigation-primary">
                <?= AmosIcons::show('link'); ?>
                <span class="hidden-xs">LINK</span>
            </button>
        </div>
    </div>

</div>