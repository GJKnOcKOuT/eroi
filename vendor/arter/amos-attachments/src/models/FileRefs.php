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
 * @package    arter\amos\attachments
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\attachments\models;

use arter\amos\attachments\FileModule;
use arter\amos\attachments\FileModuleTrait;
use arter\amos\core\record\Record;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * This is the model class for table "attach_file_refs".
 *
 * @property integer $id
 * @property string $hash
 * @property integer $attach_file_id
 * @property string $model
 * @property integer $item_id
 * @property string $attribute
 * @property string $crop
 * @property integer $protected
 * @property integer $is_main
 * @property integer $sort
 * @property File $attachFile
 */
class FileRefs extends Record
{
    use FileModuleTrait;

    const MAIN = 1;
    const NOT_MAIN = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'attach_file_refs';
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_upload',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model', 'attribute', 'item_id', 'attach_file_id', 'hash'], 'required'],
            [['item_id', 'is_main', 'sort'], 'integer'],
            [['protected'], 'safe'],
            [['model', 'hash', 'crop'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => FileModule::t('amosattachments', 'ID'),
            'hash' => FileModule::t('amosattachments', 'Hash'),
            'attach_file_id' => FileModule::t('amosattachments', 'Attach File ID'),
            'model' => FileModule::t('amosattachments', 'Model'),
            'item_id' => FileModule::t('amosattachments', 'Item ID'),
            'attribute' => FileModule::t('amosattachments', 'Attribute'),
            'crop' => FileModule::t('amosattachments', 'Crop'),
            'protected' => FileModule::t('amosattachments', 'Is Protected'),
            'is_main' => FileModule::t('amosattachments', 'Is main'),
            'sort' => FileModule::t('amosattachments', 'Sort'),
        ];
    }

    /**
     * @param string $size
     * @return string
     */
    public function getUrl($size = 'original')
    {
        return Url::to(['/' . FileModule::getModuleName() . '/file/view', 'id' => $this->id, 'hash' => $this->hash, 'size' => $size]);
    }

    /**
     * @param $size
     * @return string
     */
    public function getWebUrl($size)
    {
        return  \Yii::$app->getUrlManager()->createAbsoluteUrl(Url::to(['/' . FileModule::getModuleName() . '/file/download', 'id' => $this->id, 'hash' => $this->hash, 'size' => $size]));
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->getModule()->getFilesDirPath($this->attachFile->hash) . DIRECTORY_SEPARATOR . $this->attachFile->hash . '.' . $this->attachFile->type;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAttachFile() {
        return $this->hasOne(File::className(), ['id' => 'attach_file_id']);
    }

    /**
     * @param File $attachFile
     * @param string $crop
     * @return bool|string
     */
    public static function getHashByAttachFile(File $attachFile, $crop, $protected = true) {
        // Custom crops values?
        if (is_array($crop)) {
            $crop = json_encode($crop);
        }

        $result = FileRefs::find()->andWhere([
            'attach_file_id' => $attachFile->id,
            'model' => $attachFile->model,
            'item_id' => $attachFile->itemId,
            'attribute' => $attachFile->attribute,
            'crop' => $crop,
            'protected' => $protected
        ])->one();

        if($result && $result->id) {
            return $result->hash;
        }

        /**
         * Mew record data
         */
        $data = [
            'attach_file_id' => $attachFile->id,
            'model' => $attachFile->model,
            'item_id' => $attachFile->itemId,
            'attribute' => $attachFile->attribute,
            'is_main' => $attachFile->is_main,
            'sort' => $attachFile->sort ?: 0,
            'crop' => $crop,
            'protected' => $protected
        ];

        $newFileRef = new FileRefs();
        $newFileRef->load(['FileRefs' => $data]);
        $newFileRef->hash = md5(json_encode($data));

        if($newFileRef->validate()) {
            $newFileRef->save();

            return $newFileRef->hash;
        }

        return false;
    }
}
