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
 * @package    arter\amos\core\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\models\base;

use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\record\Record;

/**
 * Class DuplicateContentLog
 *
 * This is the base-model class for table "duplicate_content_log".
 *
 * @property integer $id
 * @property string $model_classname
 * @property string $source_model_id
 * @property string $duplicate_model_id
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @package arter\amos\core\models\base
 */
abstract class DuplicateContentLog extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'duplicate_content_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['model_classname', 'source_model_id', 'duplicate_model_id'], 'required'],
            [['model_classname'], 'string'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['source_model_id', 'duplicate_model_id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => BaseAmosModule::t('amoscore', 'ID'),
            'model_classname' => BaseAmosModule::t('amoscore', 'Model Classname'),
            'source_model_id' => BaseAmosModule::t('amoscore', 'Source Model ID'),
            'duplicate_model_id' => BaseAmosModule::t('amoscore', 'Duplicate Model Id'),
            'created_at' => BaseAmosModule::t('amoscore', 'Created At'),
            'updated_at' => BaseAmosModule::t('amoscore', 'Updated At'),
            'deleted_at' => BaseAmosModule::t('amoscore', 'Deleted At'),
            'created_by' => BaseAmosModule::t('amoscore', 'Created By'),
            'updated_by' => BaseAmosModule::t('amoscore', 'Updated By'),
            'deleted_by' => BaseAmosModule::t('amoscore', 'Deleted By'),
        ];
    }
}
