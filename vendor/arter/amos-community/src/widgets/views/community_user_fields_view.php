<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 * @var $dynamicModel \yii\base\DynamicModel
 * @var $form \arter\amos\core\forms\ActiveForm
 * @var $modelFieldImages
 */

$fields = \arter\amos\community\utilities\CommunityUserFieldUtility::getCommunityUserFieldValues();
foreach ($fields as $field){
    $value = $field->getCommunityUserFieldVals($model->user_id)->one();
    if(!empty($value->value)) {
        ?>
        <?php
        $type = null;
        if(!empty($value->userField->fieldType)) {
            $type = $value->userField->fieldType;
        }
        if($type->type == 'select_single'){
            $fieldValDef = \arter\amos\community\models\CommunityUserFieldDefaultVal::find()->andWhere(['id' => $value->value])->one();
            ?>
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12 bold"><?= $field->description ?></div>
                <div class="col-md-9 col-sm-8 col-xs-12"><?= (!empty($fieldValDef) ? $fieldValDef->value : '')?></div>
            </div>
        <?php } else if($type->type == 'date'){ ;?>
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12 bold"><?= $field->description ?></div>
                <div class="col-md-9 col-sm-8 col-xs-12"><?= (!empty($value->value) ? \Yii::$app->formatter->asDate($value->value) : '')?></div>
            </div>
       <?php  } else { ?>
            <div class="row">
                <div class="col-md-3 col-sm-4 col-xs-12 bold"><?= $field->description ?></div>
                <div class="col-md-9 col-sm-8 col-xs-12"><?= $value->value ?></div>
            </div>
            <?php
        }
    }
}
