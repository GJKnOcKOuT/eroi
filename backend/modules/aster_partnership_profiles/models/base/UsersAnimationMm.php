<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_partnership_profiles\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
 
namespace backend\modules\aster_partnership_profiles\models\base;

use backend\modules\aster_partnership_profiles\models\PartnershipProfiles;
use arter\amos\core\user\User;

/**
 * This is the base-model class for table "users_animation_mm".
 *
 * @property integer $id
 * @property integer $partnership_profile_id
 * @property integer $user_id
 * @property integer $interested
 * @property string $select_keyword
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property PartnershipProfiles $partnershipProfile
 * @property \backend\modules\aster_partnership_profiles\models\User $user
 */
class UsersAnimationMm extends \arter\amos\core\record\Record {

    
    public $num_tag;
    public $solution_sent;

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'users_animation_mm';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
		[['num_tag', 'solution_sent'], 'safe'],
            [['partnership_profile_id', 'user_id', 'select_keyword'], 'required'],
            [['partnership_profile_id', 'user_id', 'interested', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['select_keyword'], 'string', 'max' => 255],
            [['partnership_profile_id'], 'exist', 'skipOnError' => true, 'targetClass' => PartnershipProfiles::className(), 'targetAttribute' => ['partnership_profile_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => 'ID',
            'partnership_profile_id' => 'Partnership Profile ID',
            'user_id' => 'User ID',
            'interested' => 'Interested',
            'select_keyword' => 'Select Keyword',
            'num_tag' => 'TAG Correspondence',
            'solution_sent' => 'Soluzione inviata',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'deleted_at' => 'Deleted At',
            'created_by' => 'Created By',
            'updated_by' => 'Updated By',
            'deleted_by' => 'Deleted By',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPartnershipProfile() {
        return $this->hasOne(PartnershipProfiles::className(), ['id' => 'partnership_profile_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser() {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id']);
    }

}
