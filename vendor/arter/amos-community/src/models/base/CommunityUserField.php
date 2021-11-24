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


namespace arter\amos\community\models\base;

use arter\amos\community\AmosCommunity;
use Yii;

/**
 * This is the base-model class for table "community_user_field".
 *
 * @property integer $id
 * @property integer $community_id
 * @property integer $user_field_type_id
 * @property string $name
 * @property string $description
 * @property string $tooltip
 * @property integer $required
 * @property integer $unique
 * @property string $validator_classname
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\community\models\Community $community
 * @property \arter\amos\community\models\CommunityFieldType $fieldType
 * @property \arter\amos\community\models\CommunityUserFieldVal[] $communityUserFieldVals
 */
class  CommunityUserField extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'community_user_field';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['community_id', 'user_field_type_id'], 'required'],
            [['name'], 'required', 'message' => 'Attributo non può essere vuoto'],
            [['unique','community_id', 'user_field_type_id', 'required', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['validator_classname', 'description', 'tooltip'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            ['name','match','pattern'=>'/^[a-zA-Z0-9\_]+$/i',
                'message' =>  AmosCommunity::t('amoscommunity', "Il formato dell'attributo è errato, può contentenere solo lettere, numeri ed il carattere _ (esempio: my_attribute)") ],
            [['name'], 'string', 'max' => 255],
            [['community_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\community\models\Community::className(), 'targetAttribute' => ['community_id' => 'id']],
            [['user_field_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CommunityUserFieldType::className(), 'targetAttribute' => ['user_field_type_id' => 'id']],
        ];
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amoscommunity', 'ID'),
            'community_id' => Yii::t('amoscommunity', 'Member'),
            'user_field_type_id' => Yii::t('amoscommunity', 'Type of Field'),
            'name' => Yii::t('amoscommunity', 'Name'),
            'description' => Yii::t('amoscommunity', 'Description'),
            'tooltip' => Yii::t('amoscommunity', 'Tooltip'),
            'required' => Yii::t('amoscommunity', 'Required'),
            'created_at' => Yii::t('amoscommunity', 'Created at'),
            'updated_at' => Yii::t('amoscommunity', 'Updated at'),
            'deleted_at' => Yii::t('amoscommunity', 'Deleted at'),
            'created_by' => Yii::t('amoscommunity', 'Created by'),
            'updated_by' => Yii::t('amoscommunity', 'Updated at'),
            'deleted_by' => Yii::t('amoscommunity', 'Deleted at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunity()
    {
        return $this->hasOne(\arter\amos\community\models\Community::className(), ['id' => 'community_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFieldType()
    {
        return $this->hasOne(\arter\amos\community\models\CommunityUserFieldType::className(), ['id' => 'user_field_type_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunityUserFieldVals($user_id)
    {
        return $this->hasMany(\arter\amos\community\models\CommunityUserFieldVal::className(), ['user_field_id' => 'id'])->andWhere(['user_id' => $user_id]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommunityUserFieldDefaultVals()
    {
        return $this->hasMany(\arter\amos\community\models\CommunityUserFieldDefaultVal::className(), ['community_user_field_id' => 'id']);
    }



}
