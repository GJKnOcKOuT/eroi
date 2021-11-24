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


namespace arter\amos\emailmanager\models\base;

use arter\amos\core\record\Record;
use Yii;

/**
 * This is the base-model class for table "email_view".
 *
 * @property integer $id
 * @property string $module
 * @property string $view
 * @property string $content
 * @property string $params
 * @property integer $created_at
 * @property integer $updated_at
 */
class  EmailView extends Record
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_view';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'params', 'description'], 'string'],
            [['module', 'view', 'type'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'module' => Yii::t('app', 'Plugin'),
            'view' => Yii::t('app', 'Tipologia'),
            'content' => Yii::t('app', 'Content'),
            'type' => Yii::t('app', 'Type'),
            'description' => Yii::t('app', 'Description'),
            'params' => Yii::t('app', 'Params'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
