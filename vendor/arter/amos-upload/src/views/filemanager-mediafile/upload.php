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
 * @package    arter\amos\upload
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use kartik\widgets\ActiveForm; // or yii\widgets\ActiveForm
use kartik\widgets\FileInput;
//use kartik\file\FileInput; //if you have only installed 
// yii2-widget-fileinput in isolation
use yii\helpers\Html;

$form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
]);
 
// your fileinput widget for single file upload
echo $form->field($model, 'file')->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*'],
    'pluginOptions'=>['allowedFileExtensions'=>[
        'jpg',
        'gif',
        'png'
        ]
    ]]);
 
/**
* uncomment for multiple file upload
*
echo $form->field($model, 'image[]')->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*', 'multiple'=>true],
    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
]);
*
*/
echo Html::submitButton($model->isNewRecord ? 'Upload' : 'Update', [
    'class'=>$model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
);
ActiveForm::end();
