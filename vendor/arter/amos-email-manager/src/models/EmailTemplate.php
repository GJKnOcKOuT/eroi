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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\emailmanager\models;

use arter\amos\emailmanager\AmosEmail;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class EmailTemplate extends ActiveRecord
{

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'email_template';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'subject', 'heading', 'message'], 'string'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosEmail::t('amosemail', 'ID'),
            'name' => AmosEmail::t('amosemail', 'Name'),
            'subject' => AmosEmail::t('amosemail', 'Subject'),
            'heading' => AmosEmail::t('amosemail', 'Heading'),
            'message' => AmosEmail::t('amosemail', 'Message'),
            'created_at' => AmosEmail::t('amosemail', 'Created At'),
            'updated_at' => AmosEmail::t('amosemail', 'Updated At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return array_merge(parent::behaviors(), [
            'class' => TimestampBehavior::className(),
        ]);
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return '' . $this->id;
    }
}
