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


namespace arter\amos\core\models\base;

use arter\amos\core\user\User;
use Yii;

/**
 * This is the base-model class for table "user_activity_log".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $type
 * @property string $name
 * @property string $description
 * @property integer $models_classname_id
 * @property integer $record_id
 * @property string $attribute_before
 * @property string $attribute_after
 * @property string $exacuted_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\core\models\ModelsClassname $modelsClassname
 * @property \arter\amos\admin\models\User $user
 */
class  UserActivityLog extends \arter\amos\core\record\Record
{
    public $isSearch = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_activity_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'models_classname_id', 'record_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description', 'attribute_before', 'attribute_after'], 'string'],
            [['exacuted_at', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['type', 'name'], 'string', 'max' => 255],
            [['models_classname_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModelsClassname::className(), 'targetAttribute' => ['models_classname_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amosadmin', 'ID'),
            'user_id' => Yii::t('amosadmin', 'User'),
            'type' => Yii::t('amosadmin', 'Type'),
            'name' => Yii::t('amosadmin', 'Activity'),
            'description' => Yii::t('amosadmin', 'Activity description'),
            'models_classname_id' => Yii::t('amosadmin', 'Object'),
            'record_id' => Yii::t('amosadmin', 'Record id'),
            'attribute_before' => Yii::t('amosadmin', 'Attribute before'),
            'attribute_after' => Yii::t('amosadmin', 'Attribute after'),
            'exacuted_at' => Yii::t('amosadmin', 'Executed at'),
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
    public function getModelsClassname()
    {
        return $this->hasOne(\arter\amos\core\models\ModelsClassname::className(), ['id' => 'models_classname_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttributesChangeLogs()
    {
        return $this->hasMany(\arter\amos\core\models\AttributesChangeLog::className(), ['user_activity_log_id' => 'id']);
    }
}
