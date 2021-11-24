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

use Yii;

/**
 * This is the base-model class for table "content_likes".
 *
 * @property integer $id
 * @property integer $models_classname_id
 * @property integer $content_id
 * @property integer $user_id
 * @property string $user_ip
 * @property integer $likes
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\core\models\base\ModelsClassname $modelsClassname
 * @property \arter\amos\core\models\base\User $user
 */
class ContentLikes extends \arter\amos\core\record\Record {

  /**
   * @inheritdoc
   */
  public static function tableName() {
    return 'content_likes';
  }

  /**
   * @inheritdoc
   */
  public function rules() {
    return [
      [['models_classname_id', 'content_id', 'user_id', 'likes', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
     [['created_at', 'updated_at', 'deleted_at'], 'safe'],
      [['user_ip'], 'string', 'max' => 39],
      [['models_classname_id'], 'exist', 'skipOnError' => true, 'targetClass' => ModelsClassname::className(), 'targetAttribute' => ['models_classname_id' => 'id']],
      [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\core\user\User::className(), 'targetAttribute' => ['user_id' => 'id']],
    ];
  }

  /**
   * @inheritdoc
   */
  public function attributeLabels() {
    return [
      'id' => Yii::t('app', 'ID'),
      'models_classname_id' => Yii::t('app', 'Models Classname ID'),
      'content_id' => Yii::t('app', 'Content ID'),
      'user_id' => Yii::t('app', 'User ID'),
      'user_ip' => Yii::t('app', 'User Ip'),
      'likes' => Yii::t('app', 'Likes'),
      'created_at' => Yii::t('app', 'Created At'),
      'updated_at' => Yii::t('app', 'Updated At'),
      'deleted_at' => Yii::t('app', 'Deleted At'),
      'created_by' => Yii::t('app', 'Created By'),
      'updated_by' => Yii::t('app', 'Updated By'),
      'deleted_by' => Yii::t('app', 'Deleted By'),
    ];
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getModelsClassname() {
    return $this->hasOne(\arter\amos\core\models\ModelsClassname::className(), ['id' => 'models_classname_id']);
  }

  /**
   * @return \yii\db\ActiveQuery
   */
  public function getUser() {
    return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id']);
  }

}
