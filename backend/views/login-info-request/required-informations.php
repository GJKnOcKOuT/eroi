<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\views\login-info-request
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var yii\web\View $this
 * @var yii\web\View $currentView
 * @var \arter\amos\admin\models\UserProfile $model
 * @var \e015\common\models\MyUserProfile $myModelUserProfile
 */
use arter\amos\admin\AmosAdmin;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\forms\CloseSaveButtonWidget;
use arter\amos\core\module\BaseAmosModule;

$this->title = \Yii::t('logininforequest', '#informazioni_richieste');
$this->params['breadcrumbs'] = [];

$form = ActiveForm::begin([]);

$text = AmosAdmin::t('amosadmin', "#register_privacy_alert_not_accepted");

$js = <<<JS
    var selected_social_url = '';
    $('.social-link').click(function(event){
        selected_social_url = $(this).attr('href');
        event.preventDefault();
        $('#modal-privacy').modal('show');
    });
    
    $('.radio-privacy input').click(function(){
         var checked = $('.radio-privacy input:checked').val();
         if(checked == 1){
         $('.radio').append('<p class="help-block help-block-error">'+'$text'+'</p>');
         }
         else {
           $('.radio p').remove();
        }
    });

    $('#confirm-privacy-button').click(function(){
        var checked = $('.radio-privacy input:checked').val();
       if(checked == 0) {
            window.open(selected_social_url);
            $('#modal-privacy').modal('toggle');
        }
    });


JS;

$this->registerJs($js);
?>

<div class="<?= Yii::$app->controller->id ?>-form col-xs-12 nop">
    <div class="row">
        <div class="col-xs-12">
            <div class="alert alert-danger">
                <?= BaseAmosModule::t('logininforequest', '#introduction_form'); ?>
            </div>
        </div>

        <div class="col-xs-12 col-lg-6 col-sm-6">
            <div class="col-xs-12 text-bottom">
                <?=
                $form->field($myModelUserProfile, 'privacy')->radioList([
                    1 => AmosAdmin::t('amosadmin', '#cookie_policy_ok'),
                    0 => AmosAdmin::t('amosadmin', '#cookie_policy_not_ok')
                ]);
                ?>
            </div>
        </div>
    </div>


    <div class="clearfix"></div>
    <?php
    $closeSaveWidgetConf = [
        'model' => $model,
        'buttonCloseVisibility' => false,
        'buttonSaveLabel'=> BaseAmosModule::t('logininforequest', '#buttonsave'),
    ];
    ?>
    <?php
    try {
        echo CloseSaveButtonWidget::widget($closeSaveWidgetConf);
    } catch (Exception $e) {
        
    }
    ?>
</div>
<?php ActiveForm::end(); ?>
