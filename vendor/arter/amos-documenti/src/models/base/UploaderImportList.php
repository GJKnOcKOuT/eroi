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
 * @package    arter\amos\documenti\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\models\base;

use arter\amos\core\record\Record;
use Yii;

/**
 * This is the base-model class for table "uploader_import_list".
 *
 * @property integer $id
 * @property string $name_file
 * @property string $path_log
 * @property integer $successfull
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 */

class UploaderImportList extends Record
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'uploader_import_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_file'], 'required'],
            [['successfull', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name_file', 'path_log'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('amosdocumenti', 'ID'),
            'name_file' => Yii::t('amosdocumenti', 'File'),
            'path_log' => Yii::t('amosdocumenti', 'File log'),
            'successfull' => Yii::t('amosdocumenti', 'Successo'),
            'created_at' => Yii::t('amosdocumenti', 'Creato il'),
            'updated_at' => Yii::t('amosdocumenti', 'Updated at'),
            'deleted_at' => Yii::t('amosdocumenti', 'Deleted at'),
            'created_by' => Yii::t('amosdocumenti', 'Created by'),
            'updated_by' => Yii::t('amosdocumenti', 'Updated at'),
            'deleted_by' => Yii::t('amosdocumenti', 'Deleted at'),
        ];
    }
    
}
