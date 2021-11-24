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
 * @package    arter\amos\admin\widgets\graphics\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\widgets\graphics\WidgetGraphicMyProfile;
use arter\amos\core\helpers\Html;

/**
 * @var \yii\web\View $this
 * @var WidgetGraphicMyProfile $widget
 * @var \arter\amos\admin\models\UserProfile $userProfile
 */

?>

<div class="grid-item">
    <div class="box-widget myprofile">
        <div class="box-widget-toolbar dark-toolbar row nom">
            <h2 class="box-widget-title col-xs-10 nop"><?= AmosAdmin::t('amosadmin', 'Il mio profilo') ?></h2>
        </div>
        <section><h2 class="sr-only"><?= AmosAdmin::t('amosadmin', 'Il mio profilo') ?></h2>
            <div role="listbox">
                <div class="widget-listbox-option row list-items" role="option">
                    <article class="col-xs-12 nop">
                        <div class="icon-admin-wgt">
                            <span class="pull-left">
                                <?= Html::a(
                                    $widget->getUserProfileRoundImage(),
                                    ['/admin/user-profile/update', 'id' => $userProfile->id],
                                    ['title' => AmosAdmin::t('amosadmin', '#go_to_your_profile'), 'class' => 'container-square-img-sm']
                                ) ?>
                            </span>
                        </div>
                        <div class="text-admin-wgt">
                            <h3 class="box-widget-subtitle"><?= $userProfile->nomeCognome ?></h3>
                            <p class="box-widget-text"><?= $widget->getBoxWidgetText() ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </article>
                </div>
            </div>
        </section>
    </div>
</div>
