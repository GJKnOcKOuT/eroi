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

use Yii;

/**
 * This is the base-model class for table "community_user_field_val".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $user_field_id
 * @property string $value
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\community\models\CommunityUserField $userField
 * @property \arter\amos\core\user\User $user
 */
class  CommunityUserFieldVal extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'community_user_field_val';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'user_field_id', 'value'], 'required'],
            [['user_id', 'user_field_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['value'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['user_field_id'], 'exist', 'skipOnError' => true, 'targetClass' => CommunityUserField::className(), 'targetAttribute' => ['user_field_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\core\user\User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amoscommunity', 'ID'),
            'user_id' => Yii::t('amoscommunity', 'User'),
            'user_field_id' => Yii::t('amoscommunity', 'Field'),
            'value' => Yii::t('amoscommunity', 'Value'),
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
    public function getUserField()
    {
        return $this->hasOne(\arter\amos\community\models\CommunityUserField::className(), ['id' => 'user_field_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id']);
    }
}
