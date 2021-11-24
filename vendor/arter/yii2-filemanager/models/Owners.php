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

/**
 * This is the model class for table "filemanager_mediafiles".
 *
 * @property integer $mediafile_id
 * @property integer $owner_id
 * @property string $owner
 * @property string $owner_attribute
 *
 * @property Mediafile $mediafile
 */
class Owners extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'filemanager_owners';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['mediafile_id', 'owner_id', 'owner_attribute', 'owner'], 'required'],
            [['mediafile_id', 'owner_id'], 'integer'],
            [['owner', 'owner_attribute'], 'string', 'max' => 255]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMediafile()
    {
        return $this->hasOne(Mediafile::className(), ['id' => 'mediafile_id']);
    }
}
