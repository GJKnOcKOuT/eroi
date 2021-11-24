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


namespace arter\amos\een\models\base;

use Yii;

/**
 * This is the base-model class for table "een_tag_een".
 *
 * @property integer $id
 * @property string $description
 * @property string $id_een
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 */
class EenTagEen extends \arter\amos\core\record\Record
{
    public $isSearch = false;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'een_tag_een';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['description', 'id_een'], 'string', 'max' => 128],
            [['name'], 'string', 'max' => 256],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('Module', 'ID'),
            'name' => Yii::t('Module', 'Nome'),
            'description' => Yii::t('Module', 'Descrizione'),
            'id_een' => Yii::t('Module', 'TAG EEN'),
            'created_at' => Yii::t('Module', 'Created at'),
            'updated_at' => Yii::t('Module', 'Updated at'),
            'deleted_at' => Yii::t('Module', 'Deleted at'),
            'created_by' => Yii::t('Module', 'Created by'),
            'updated_by' => Yii::t('Module', 'Updated by'),
            'deleted_by' => Yii::t('Module', 'Deleted by'),
        ];
    }

    public function getEenTagS3TagEenMm()
    {
        return $this->hasOne(\arter\amos\een\models\EenTagS3TagEenMm::class, ['een_tag_een_id' => 'id']);
    }
}