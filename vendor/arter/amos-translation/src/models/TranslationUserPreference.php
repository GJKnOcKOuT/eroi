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
 * @package    arter\amos\translation
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\translation\models;

use Yii;

/**
 * This is the base-model class for table "translation_user_preference".
 *
 * @property integer $user_id
 * @property string $lang
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \backend\modules\prova\models\User $user
 */
class TranslationUserPreference extends \arter\amos\core\record\Record
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'translation_user_preference';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'lang'], 'required'],
            [['user_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['lang'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \arter\amos\core\user\User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => Yii::t('amostranslation', 'User ID'),
            'lang' => Yii::t('amostranslation', 'Lang'),
            'created_at' => Yii::t('amostranslation', 'Created At'),
            'updated_at' => Yii::t('amostranslation', 'Updated At'),
            'deleted_at' => Yii::t('amostranslation', 'Deleted At'),
            'created_by' => Yii::t('amostranslation', 'Created By'),
            'updated_by' => Yii::t('amostranslation', 'Updated By'),
            'deleted_by' => Yii::t('amostranslation', 'Deleted By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id']);
    }

    public function representingColumn()
    {
        return [
            //inserire il campo o i campi rappresentativi del modulo
        ];
    }

    public function attributeHints()
    {
        return [
        ];
    }

    /**
     * Returns the text hint for the specified attribute.
     * @param string $attribute the attribute name
     * @return string the attribute hint
     * @see attributeHints
     */
    public function getAttributeHint($attribute)
    {
        $hints = $this->attributeHints();
        return isset($hints[$attribute]) ? $hints[$attribute] : null;
    }
}