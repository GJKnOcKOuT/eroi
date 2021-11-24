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

namespace arter\amos\community\validators;


use arter\amos\community\AmosCommunity;
use arter\amos\community\models\CommunityUserFieldVal;
use yii\validators\Validator;

class UniqueUserValCommunityValidator extends Validator
{

    public $community_id;

    /**
     * @param \yii\base\Model $model
     * @param string $attribute
     * @throws \yii\base\InvalidConfigException
     */
    function validateAttribute($model, $attribute)
    {

       $value = $model->$attribute;
       $fieldValCount = CommunityUserFieldVal::find()
           ->innerJoin('community_user_field', 'community_user_field_val.user_field_id = community_user_field.id')
           ->andWhere(['value' => $value])
           ->andWhere(['!=', 'user_id', \Yii::$app->user->id])
           ->andWhere(['community_id' => $this->community_id])
           ->count();
       if($fieldValCount > 0){
           $this->addError($model, $attribute, AmosCommunity::t('amoscommunity', 'Questo campo deve essere univoco'));
           return false;
       }
       return true;
    }




}