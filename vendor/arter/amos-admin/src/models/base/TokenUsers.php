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


namespace arter\amos\admin\models\base;

use Yii;

/**
 * This is the base-model class for table "token_users".
 *
 * @property integer $id
 * @property integer $token_group_id
 * @property integer $user_id
 * @property string $token
 * @property integer $used
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property TokenGroup $user
 * @property \arter\amos\core\user\User $user0
 */
class TokenUsers extends \arter\amos\core\record\Record
{


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'token_users';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['token_group_id', 'user_id'], 'required'],
            [['token_group_id', 'user_id', 'used', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['token'], 'string', 'max' => 255],
            [['token_group_id'], 'exist', 'skipOnError' => true, 'targetClass' => TokenGroup::className(), 'targetAttribute' => ['token_group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\core\user\User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amosadmin', 'ID'),
            'token_group_id' => Yii::t('amosadmin', 'Token group'),
            'user_id' => Yii::t('amosadmin', 'User'),
            'token' => Yii::t('amosadmin', 'Token'),
            'used' => Yii::t('amosadmin', 'Used'),
            'created_at' => Yii::t('amosadmin', 'Created at'),
            'updated_at' => Yii::t('amosadmin', 'Updated at'),
            'deleted_at' => Yii::t('amosadmin', 'Deleted at'),
            'created_by' => Yii::t('amosadmin', 'Created by'),
            'updated_by' => Yii::t('amosadmin', 'Updated at'),
            'deleted_by' => Yii::t('amosadmin', 'Deleted at'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTokenGroup()
    {
        return $this->hasOne(TokenGroup::className(), ['id' => 'token_group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id']);
    }
}
