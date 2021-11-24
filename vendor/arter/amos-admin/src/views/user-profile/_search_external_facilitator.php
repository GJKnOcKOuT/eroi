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
 * @package    arter\amos\core\forms\editors\m2mwidget\views
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\helpers\Html;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\utilities\JsUtility;
use yii\web\View;

/**
 * @var yii\web\View $this
 * @var \yii\db\ActiveRecord $model
 * @var string $pjaxContainerId
 * @var string $gridViewContainerId
 * @var string $gridId
 * @var bool $useCheckbox
 */

$post = Yii::$app->getRequest()->post();
$genericSearchFieldId = 'm2mwidget-generic-search-textinput';
$fromGenericSearchFieldId = 'm2mwidget-from-generic-search-hiddeninput';
$resetId = 'm2mwidget-generic-search-reset-btn';
$submitId = 'm2mwidget-generic-search-submit-btn';
$gridId = 'associate-external-facilitator';
$isModal = false;
$useCheckbox = false;


$form = \arter\amos\core\forms\ActiveForm::begin();
?>
<div class="m2mwidget-generic-search">
    <div class="col-xs-12 nop m-15-0">
        <div class="col-sm-6 col-lg-4 nop">
            <!-- TODO Rimuovere hiddenInput fromGenericSearch quando funzionerà il pjax -->
            <?= Html::hiddenInput('fromGenericSearch', 0, [
                'id' => 'fromGenericSearch'
            ]); ?>

            <?= Html::textInput('genericSearch', (isset($post['genericSearch']) ? $post['genericSearch'] : null), [
                'placeholder' => BaseAmosModule::t('amoscore', 'Search') . '...',
                'id' => $gridId . 'associate-external-facilitator-search-field', 'class' => 'form-control'
            ]); ?>
        </div>

        <div class="col-sm-6 col-lg-8">
            <?= Html::a(BaseAmosModule::t('amoscore', 'Reset'), ['/admin/user-profile/send-request-external-facilitator', 'id' => $model->id ],['class' => 'btn btn-secondary', 'id' => $gridId . '-reset-search-btn']) ?>
            <?= Html::submitButton(BaseAmosModule::t('amoscore', 'Search'), ['class' => 'btn btn-navigation-primary', 'id' => $gridId . '-search-btn']) ?>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<?php
\arter\amos\core\forms\ActiveForm::end();
?>
