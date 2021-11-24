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
 * This model allows for storing of mail entries linked to a specific audit entry
 */

namespace arter\amos\audit\models;

use arter\amos\audit\components\db\ActiveRecord;
use Yii;

/**
 * AuditMail
 *
 * @package arter\amos\audit\models
 * @property int    $id
 * @property int    $entry_id
 * @property string $created
 * @property int    $successful
 * @property string $from
 * @property string $to
 * @property string $reply
 * @property string $cc
 * @property string $bcc
 * @property string $subject
 * @property string $text
 * @property string $html
 * @property string $data
 *
 * @property AuditEntry    $entry
 */
class AuditMail extends ActiveRecord
{
    protected $serializeAttributes = ['text', 'html', 'data'];

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%audit_mail}}';
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
            'id' => Yii::t('audit', 'ID'),
            'entry_id' => Yii::t('audit', 'Entry ID'),
            'created' => Yii::t('audit', 'Created'),
            'successful' => Yii::t('audit', 'Successful'),
            'from' => Yii::t('audit', 'From'),
            'to' => Yii::t('audit', 'To'),
            'reply' => Yii::t('audit', 'Reply'),
            'cc' => Yii::t('audit', 'CC'),
            'bcc' => Yii::t('audit', 'BCC'),
            'subject' => Yii::t('audit', 'Subject'),
            'text' => Yii::t('audit', 'Text Body'),
            'html' => Yii::t('audit', 'HTML Body'),
            'data' => Yii::t('audit', 'Data'),
        ];
    }

}