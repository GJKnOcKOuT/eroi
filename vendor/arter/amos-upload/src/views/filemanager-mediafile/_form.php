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

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\builder\Form;
use kartik\datecontrol\DateControl;
use yii\bootstrap\Tabs;

/**
* @var yii\web\View $this
* @var arter\amos\upload\models\FilemanagerMediafile $model
* @var yii\widgets\ActiveForm $form
*/


?>

<div class="filemanager-mediafile-form">

    <?php $form = ActiveForm::begin(['type'=>ActiveForm::TYPE_VERTICAL]);  ?>
    <div class="form-actions">

        <?=    Html::submitButton( $model->isNewRecord ?
        Yii::t('amosupload', 'Crea') :
        Yii::t('amosupload', 'Aggiorna'),
        [
        'class' => $model->isNewRecord ?
        'btn btn-success' :
        'btn btn-primary'
        ]); ?>

    </div>


    
        
        <?php  $this->beginBlock('generale'); ?>
                <div class="clearfix"></div>
        <?php  $this->endBlock('generale'); ?>

        <?php   $itemsTab[] = [
        'label' => Yii::t('amosupload', 'Generale '),
        'content' => $this->blocks['generale'],
        ];
         ?>    

    <?=  Tabs::widget(
    [
    'encodeLabels' => false,
    'items' => $itemsTab
    ]
    );
     ?>
    <?php  ActiveForm::end();  ?>
</div>
