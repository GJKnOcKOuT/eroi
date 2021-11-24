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


namespace app\models\base;

use Yii;
use arter\amos\core\record\Record;
use arter\amos\sondaggi\AmosSondaggi;

/**
 * This is the base-model class for table "sondaggi_content_model".
 *
 * @property integer $id
 * @property string $class_name
 * @property string $field_name
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 */
class SondaggiContentModel extends Record {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'sondaggi_content_model';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['id'], 'required'],
            [['id', 'created_by', 'updated_by', 'deleted_by'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['class_name'], 'string', 'max' => 255],
            [['field_name'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => AmosSondaggi::t('amossondaggi','ID'),
            'class_name' => AmosSondaggi::t('amossondaggi','Class Name'),
            'field_name' => AmosSondaggi::t('amossondaggi','Filed Name'),
            'created_at' => AmosSondaggi::t('amossondaggi','Created At'),
            'updated_at' => AmosSondaggi::t('amossondaggi','Updated At'),
            'deleted_at' => AmosSondaggi::t('amossondaggi','Deleted At'),
            'created_by' => AmosSondaggi::t('amossondaggi','Created By'),
            'updated_by' => AmosSondaggi::t('amossondaggi','Updated By'),
            'deleted_by' => AmosSondaggi::t('amossondaggi','Deleted By'),
        ];
    }

}
