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
 * @package    arter\amos\admin\views\user-profile\boxes
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfileStatiCivili;
use arter\amos\admin\models\UserProfileTitoliStudio;
use arter\amos\core\icons\AmosIcons;
use yii\helpers\ArrayHelper;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 */

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

?>
<section class="section-data">
    <h2>
        <?= AmosIcons::show('tag-more'); ?>
        <?= AmosAdmin::tHtml('amosadmin', 'Ulteriori Informazioni'); ?>
    </h2>
    <div class="row">
        <div class="col-lg-4 col-sm-4">
            <div class="select">
                <?= $form->field($model, 'nazionalita')->dropDownList(['Extra UE' => 'Extra UE', 'Italiana' => 'Italiana', 'UE' => 'UE',], ['prompt' => 'Seleziona...', 'disabled' => false]) ?>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="select">
                <?=
                // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
                $form->field($model, 'user_profile_titoli_studio_id')->dropDownList(
                    ArrayHelper::map(UserProfileTitoliStudio::find()->all(), 'id', 'denominazione'), ['disabled' => false, 'prompt' => AmosAdmin::t('amosadmin', 'Seleziona...')]);
                
                ?>
            </div>
        </div>
        <div class="col-lg-4 col-sm-4">
            <div class="select">
                <?=
                // generated by schmunk42\giiant\crud\providers\RelationProvider::activeField
                $form->field($model, 'user_profile_stati_civili_id')->dropDownList(
                    ArrayHelper::map(UserProfileStatiCivili::find()->all(), 'id', 'nome'), ['disabled' => false, 'prompt' => AmosAdmin::t('amosadmin', 'Seleziona...')]);
                
                ?>
            </div>
        </div>

    </div>
</section>
