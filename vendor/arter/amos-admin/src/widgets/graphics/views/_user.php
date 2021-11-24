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

use arter\amos\core\helpers\Html;
use arter\amos\admin\utility\UserProfileUtility;
use arter\amos\admin\widgets\graphics\WidgetGraphicsUsers;
use arter\amos\organizzazioni\models\ProfiloUserMm;

/**
 * @var yii\web\View $this
 * @var \arter\amos\admin\models\UserProfile $model
 */
?>

<article class="user-box">       
    <div class="profile-icon container-round-img">
        <?= Html::img($model->getAvatarUrl('square_small'), [
            'class' => Yii::$app->imageUtility->getRoundRelativeImage($model)['class'],
            'alt' => $model->id
        ]) ?>
    </div>
    <div class="profile-info">
        <span class="name surname"><?= $model->nomeCognome ?></span>
        <?php if(!is_null($model->userOrganization)): ?>
            <span class="company"><?= $model->userOrganization->getNameField() ?></span>
        <?php endif; ?>
        <?php if($model->user_profile_role_other): ?>
            <span class="role"><?= $model->user_profile_role_other ?></span>
        <?php endif; ?>
    </div>
</article>