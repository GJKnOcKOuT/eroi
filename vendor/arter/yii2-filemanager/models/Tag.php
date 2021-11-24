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


namespace pendalf89\filemanager\models;

use Yii;
use yii\web\UploadedFile;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\imagine\Image;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\helpers\Inflector;
use pendalf89\filemanager\Module;
use pendalf89\filemanager\models\Owners;
use Imagine\Image\ImageInterface;

/**
 * This is the model class for table "filemanager_tag".
 *
 * @property integer $id
 * @property string $name
 *
 * relations
 * @property Mediafile[] $mediafiles
 */
class Tag extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filemanager_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 100],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => Module::t('main', 'Tag'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMediafiles() {
        return $this->hasMany(Mediafile::className(), ['id' => 'mediafile_id'])
            ->viaTable('filemanager_mediafile_tag', ['tag_id' => 'id']);
    }

	/**
	 * Removes unused tags
	 *
	 * @return int
	 * @throws \yii\db\Exception
	 */
	public static function removeUnusedTags()
	{
		return Yii::$app->db->createCommand(
			'DELETE filemanager_tag
			FROM
				filemanager_tag
			LEFT JOIN filemanager_mediafile_tag ON id = tag_id
			WHERE
				ISNULL(mediafile_id)'
		)->execute();
	}
}
