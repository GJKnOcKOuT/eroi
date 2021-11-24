<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use arter\amos\core\helpers\Html;

$avatar = '';
if (isset($model->profile)) {
$modelProfile =  $model->profile;
$avatar = $modelProfile->getAvatarUrl('square_small');
//$avatar = $model->profile->getAvatarUrl('small');
//$avatar_id = $model->profile->avatar_id;
}
?>
<a href="<?= '/messages/' . $model->id ?>">
    <div class="item-chat media nop" data-key=""
         data-user-contact="<?= $model->id ?>">
        <div class="media-left">
            <div class="container-round-img">
                <?= Html::img($modelProfile->getAvatarUrl('square_small'), [
                    'class' => Yii::$app->imageUtility->getRoundRelativeImage($modelProfile)['class'],
                    'alt' => $modelProfile->id
                ]) ?>
            </div>
        </div>
        <div class="media-body">
            <h5 class="media-heading"><strong><?= $model->name ?></strong></h5>
            <?= $model->username ?>
        </div>
    </div>
</a>
