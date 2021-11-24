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
 * @package    arter\amos\admin\views\first-access-wizard\parts
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\core\helpers\Html;

/**
 * @var \arter\amos\admin\models\UserProfile $model
 */

?>

<section>
    <div class="row">
        <div class="col-xs-3 col-md-2">
            <div class="img-profile">
                <?php
                $url = $model->getAvatarUrl('original', [
                    'class' => 'img-responsive'
                ]);
                Yii::$app->imageUtility->methodGetImageUrl = 'getAvatarUrl';
                try {
                    $getHorizontalImageClass = Yii::$app->imageUtility->getHorizontalImage($model->userProfileImage)['class'];
                    $getHorizontalImageMarginLeft = 'margin-left:' . Yii::$app->imageUtility->getHorizontalImage($model->userProfileImage)["margin-left"] . 'px;margin-top:' . Yii::$app->imageUtility->getHorizontalImage($model->userProfileImage)["margin-top"] . 'px;';
                } catch (\Exception $ex) {
                    $getHorizontalImageClass = '';
                    $getHorizontalImageMarginLeft = '';
                }
                ?>
                <?= Html::img($url, [
                    'class' => 'img-responsive ' . $getHorizontalImageClass,
                    'style' => $getHorizontalImageMarginLeft,
                    'alt' => AmosAdmin::t('amosadmin', 'Profile Image')
                ]);
                ?>
            </div>
        </div>
        <div class="col-xs-9 col-md-10 nop">
            <div>
                <h2><strong><?= $model->getNomeCognome() ?></strong></h2>
            </div>
            <div>
                <?= ($model->presentazione_breve ? $model->presentazione_breve : '-') ?>
            </div>
        </div>
    </div>
</section>
<hr>
