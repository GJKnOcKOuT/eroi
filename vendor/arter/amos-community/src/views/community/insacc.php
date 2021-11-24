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
 * @package    arter\amos\community\views\community
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\community\AmosCommunity;
use arter\amos\community\models\Community;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\helpers\Html;
use kartik\select2\Select2;
use yii\bootstrap\Modal;

Modal::begin([
    'header' => AmosCommunity::t('amoscommunity', 'Invite Users'),
    'id' => 'community-members-grid-modal',
    'size' => Modal::SIZE_LARGE
]);

$id = Yii::$app->request->getQueryParam('id');
$url = '/community/community/insass-m2m?id='.$id;
$community = Community::findOne($id);
$roles = $community->getContextRoles();
$rolesArray = [];
foreach ($roles as $role) {
    $rolesArray[$role] = $role;
}

$js = <<<JS

$("#invite-form").submit(function(e) { 
    e.preventDefault();
    var postdata = $(this).serializeArray();
    var formurl = $(this).attr("action");
    $.ajax( {
        url : formurl,
        type: "POST", 
        data : postdata, 
        success:function(data, textStatus, jqXHR) { //data: returning of data from the server
            $('#community-members-grid-modal').modal('hide');
            $('.modal-backdrop').remove();
            $("#reset-search-btn-community-members-grid").click();
        }, 
        error: function(jqXHR, textStatus, errorThrown) { 
            //if fails 
        }
    });
    e.preventDefault(); // default action us stopped here 
    return false;
}); 
    
JS;
$this->registerJs($js, \yii\web\View::POS_READY);

?>

    <div id="insacc-container">

        <?php $form = ActiveForm::begin(['id' => 'invite-form', 'action' => $url]); ?>
        <?php echo $form->field($model, 'nome')->textInput() ?>
        <?php echo $form->field($model, 'cognome')->textInput() ?>
        <?php echo $form->field($model, 'email')->textInput() ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($model, 'role')->widget(Select2::className(), [
                    'data' => $rolesArray,
                    'language' => 'it',
                    'options' => [
                        'multiple' => false,
                        'id' => 'role',
                        'placeholder' => AmosCommunity::t('amoscommunity', 'Select') . '...',
                        'class' => 'dynamicCreation',
                        'data-model' => 'community_user_mm',
                        'data-field' => 'role',
                        'data-module' => 'community_user_mm',
                        'data-entity' => 'community_user_mm',
                        'data-toggle' => 'tooltip',
                        'value' => $community->getBaseRole()
                        //            'disabled' => (!$model->isNewRecord)? true : false
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                    'pluginEvents' => [
                        "select2:open" => "dynamicInsertOpening"
                    ]
                ])->label(AmosCommunity::t('amoscommunity', 'Role'), ['for' => 'role']) ?>
            </div>
        </div>

        <div class='bk-btnFormContainer'>
            <?= Html::submitButton(AmosCommunity::t('amoscommunity', 'Save'), ['class' => 'btn btn-primary', 'id' => 'save-modal']) ?>
            <?= Html::a(AmosCommunity::t('amoscommunity', 'Cancel'), null,
                ['class' => 'btn btn-secondary', 'data-dismiss' => 'modal']) ?>
        </div>
        <?php ActiveForm::end(); ?>
    </div>

<?php
Modal::end();
?>
