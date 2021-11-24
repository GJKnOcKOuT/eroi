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
 */

namespace arter\amos\community\utilities;


use arter\amos\community\models\Community;
use arter\amos\community\models\CommunityUserField;
use arter\amos\community\models\CommunityUserFieldVal;
use arter\amos\community\validators\UniqueUserValCommunityValidator;
use arter\amos\core\validators\CFValidator;
use yii\base\DynamicModel;
use yii\data\ActiveDataProvider;

class CommunityUserFieldUtility
{

    /**
     * @param $community_id
     * @return null|DynamicModel
     */
    public static function loadDynamicFields($community_id, $user_id = null)
    {
        $dynamicModel = null;
        $community = Community::findOne($community_id);
        if ($community) {

            $fields = $community->communityUserField;
            $attributesTypes = [];
            $attributesLabels = [];
            $attributes = ['attributesTypes','attributesLabel'];
            $requiredAtributes = [];
            $relationDefaultValues = [];
            $uniqueAttributes = [];
            $attributesWithValidators = [];

            /** @var  $field CommunityUserField */
            foreach ($fields as $field) {
                if($field->user_field_type_id == 4){
                    $relationDefaultValues [$field->name] = $field->communityUserFieldDefaultVals;
                    $attributes [] = 'relation_'.$field->name;
                }
                $attributes [] = $field->name;
                $attributesTypes [$field->name] = $field->fieldType->type;
                $attributesLabels [$field->name] = $field->description;
                if ($field->required) {
                    $requiredAtributes [] = $field->name;
                }
                if($field->unique){
                    $uniqueAttributes [] = $field->name;
                }

                if(!empty($field->validator_classname)){
                    $attributesWithValidators [$field->name] = $field->validator_classname;
                }
            }
//            die;

            $dynamicModel = new DynamicModel($attributes);
            $dynamicModel->attributesTypes = $attributesTypes;
            $dynamicModel->attributesLabel = $attributesLabels;
            $dynamicModel->addRule($attributes, 'safe');
            $dynamicModel->addRule($uniqueAttributes, UniqueUserValCommunityValidator::className(), ['community_id' => $community_id]);
            $dynamicModel->addRule($requiredAtributes, 'required');
            foreach ($attributesWithValidators as $attr => $validator){
                if(class_exists($validator)) {
                    $classValidator = $validator::className();
                    $dynamicModel->addRule($attr, $classValidator);
                }
            }
            foreach ($relationDefaultValues as $attr => $values){
                $attributeName = 'relation_'.$attr;
                $tmp = [];
                foreach ($values as $val){
                    $tmp [$val->id]= $val->value;
                }
                $dynamicModel->$attributeName = $tmp;
            }

            $dynamicModel = self::loadFieldsToDynamicModel($dynamicModel, $community, $user_id);
        }
        return $dynamicModel;
    }


    /**
     * @return DynamicModel
     */
    public static function loadFieldsToDynamicModel($dynamicModel, $community, $user_id = null)
    {
        if(is_null($user_id)){
            $user_id = \Yii::$app->user->id;
        }
        $fields = $community->communityUserField;
        foreach ($fields as $field) {
            $value = $field->getCommunityUserFieldVals($user_id)->one();
            if ($value) {
                $attribute = $field->name;
                $dynamicModel->$attribute = $value->value;
            }
        }
        return $dynamicModel;
    }


    /**
     * @param $dynamicModel DynamicModel
     * @param $attributesTypes
     * @param $community
     * @throws \yii\base\InvalidConfigException
     */
    public static function saveFieldsFormDynamicModel($dynamicModel, $attributesTypes, $community)
    {
        foreach ($dynamicModel->attributes() as $attribute) {
            $modelField = CommunityUserField::find()->andWhere(['community_id' => $community->id, 'name' => $attribute])->one();
            if ($modelField) {
                $val = $modelField->getCommunityUserFieldVals(\Yii::$app->user->id)->one();
                if ($attributesTypes[$attribute] != 'file') {
                    if ($val) {
                        $val->value = $dynamicModel->$attribute;
                    } else {
                        $val = new CommunityUserFieldVal();
                        $val->user_id = \Yii::$app->user->id;
                        $val->user_field_id = $modelField->id;
                        $val->value = $dynamicModel->$attribute;
                    }
                    $val->save();
                }
//                if($attributesTypes[$attribute] == 'file'){
//                    $this->saveFileFields($attribute, $modelField);
//                }
            }
        }
        return true;
    }


    public static function getCommunityUserFieldValues()
    {
        $fields = [];
        $moduleCwh = \Yii::$app->getModule('cwh');
        if (isset($moduleCwh) && !empty($moduleCwh->getCwhScope())) {
            $scope = $moduleCwh->getCwhScope();
            if (isset($scope['community'])) {
                $id = $scope['community'];
                $community = Community::findOne($id);
                $fields = $community->communityUserField;
                if(empty($fields) && $community->parent_id){
                    $community = Community::findOne($community->parent_id);
                    $fields = $community->communityUserField;
                }
            }
        }
        return $fields;
    }
}