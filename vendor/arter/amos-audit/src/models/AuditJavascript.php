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

/**
 * This model allows for storing of javascript logging entries linked to a specific audit entry
 */

namespace arter\amos\audit\models;

use arter\amos\audit\components\db\ActiveRecord;
use Yii;

/**
 * AuditJavascript
 *
 * @package arter\amos\audit\models
 * @property int    $id
 * @property int    $entry_id
 * @property string $created
 * @property string $type
 * @property string $message
 * @property string $origin
 * @property string $data
 *
 * @property AuditEntry    $entry
 */
class AuditJavascript extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%audit_javascript}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEntry()
    {
        return $this->hasOne(AuditEntry::className(), ['id' => 'entry_id']);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('audit', 'ID'),
            'entry_id'  => Yii::t('audit', 'Entry ID'),
            'created'   => Yii::t('audit', 'Created'),
            'type'      => Yii::t('audit', 'Type'),
            'message'   => Yii::t('audit', 'Message'),
            'origin'    => Yii::t('audit', 'Origin'),
            'data'      => Yii::t('audit', 'Data'),
        ];
    }
}