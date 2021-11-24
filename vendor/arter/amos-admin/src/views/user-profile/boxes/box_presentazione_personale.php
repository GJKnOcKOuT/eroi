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
use arter\amos\admin\base\ConfigurationManager;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 */

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

?>

<section>
    <?php if ($adminModule->confManager->isVisibleField('presentazione_personale', ConfigurationManager::VIEW_TYPE_FORM)): ?>
        <div class="row">
            <div class="col-xs-12">
                <?= $form->field($model, 'presentazione_personale')->textarea([
                    'rows' => 6,
                    'readonly' => false,
                    'maxlength' => true,
                    'placeholder' => AmosAdmin::t('amosadmin', 'Enter a more detailed professional introduction up to 600 characters') . '.'
                ])->label(AmosAdmin::t('amosadmin', 'Professional introduction'), ['class' => 'bold']); ?>
            </div>
        </div>
    <?php endif; ?>
</section>
