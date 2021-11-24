<!DOCTYPE html>
<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

use app\assets\SocialAsset;
use arter\amos\core\forms\ActiveForm;
use arter\amos\core\helpers\Html;

SocialAsset::register($this);

?>
<div>
    <?php
    //Uikit::trace($data);
    //Uikit::trace($debug);
    //Uikit::trace($request);
    //Uikit::trace($model->attributes());
    $form            = ActiveForm::begin([
            'options' => ['enctype' => 'multipart/form-data', 'autocomplete' => "off",'target'=>'_blank'],
            'encodeErrorSummary' => false,
            'fieldConfig' => ['errorOptions' => ['encode' => false, 'class' => 'help-block']]
    ]);
    ?>


    <div class="uk-form-controls">
        <div>
            <?php
                echo Html::hiddenInput('id', $data['id']);
                echo !empty($data['description']) ? $data['description'] : 'Export';
            ?>
        </div>
        <?=
        Html::submitButton(!empty($data['submitlabel']) ? $data['submitlabel'] : 'Submit',
            ['class' => 'btn btn-primary'])
        ?>
    </div>
</div>
<?php
ActiveForm::end();
?>
</div>
