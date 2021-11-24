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
use arter\amos\attachments\components\CropInput;

/**
 * @var yii\web\View $this
 * @var arter\amos\core\forms\ActiveForm $form
 * @var arter\amos\admin\models\UserProfile $model
 * @var arter\amos\core\user\User $user
 */

/** @var AmosAdmin $adminModule */
$adminModule = Yii::$app->controller->module;

?>

<?php if ($adminModule->confManager->isVisibleField('userProfileImage', ConfigurationManager::VIEW_TYPE_FORM)): ?>
    <?= $form->field($model,'userProfileImage')->widget(CropInput::classname(), [
        'enableUploadFromGallery' => false,
        'jcropOptions' => [ 'aspectRatio' => '1']
    ])->label(AmosAdmin::t('amosadmin', '#image_field'))->hint(AmosAdmin::t('amosadmin', '#image_field_hint')); ?>
<?php endif; ?>
