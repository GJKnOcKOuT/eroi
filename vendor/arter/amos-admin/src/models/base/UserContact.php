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
 * @package    arter\amos\admin\models\base
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\models\base;

use arter\amos\admin\AmosAdmin;
use arter\amos\core\record\AmosRecordAudit;

/**
 * Class UserContact
 *
 * This is the base-model class for table "user_contact".
 * @package arter\amos\admin\models\base
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $contact_id
 * @property string $status
 * @property string $accepted_at
 * @property integer $reminders_count
 * @property string $last_reminder_at
 * @property string $created_at
 * @property string $updated_at
 * @property string $deleted_at
 * @property integer $created_by
 * @property integer $updated_by
 * @property integer $deleted_by
 *
 * @property \arter\amos\admin\models\UserProfile $userProfile
 * @property \arter\amos\admin\models\UserProfile $contactUserProfile
 */
class UserContact extends AmosRecordAudit
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_contact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'contact_id', 'status'], 'required'],
            [['status'], 'string'],
            [['reminders_count'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => AmosAdmin::t('amosadmin', 'ID'),
            'user_id' => AmosAdmin::t('amosadmin', 'User ID'),
            'contact_id' => AmosAdmin::t('amosadmin', 'Contact User ID'),
            'status' => AmosAdmin::t('amosadmin', 'Status'),
            'accepted_at' => AmosAdmin::t('amosadmin', 'Accepted at'),
            'reminders_count' => AmosAdmin::t('amosadmin', 'Number of reminders'),
            'last_reminder_at' => AmosAdmin::t('amosadmin', 'Last reminder sent at'),
            'created_at' => AmosAdmin::t('amosadmin', 'Created at'),
            'updated_at' => AmosAdmin::t('amosadmin', 'Updated at'),
            'deleted_at' => AmosAdmin::t('amosadmin', 'Deleted at'),
            'created_by' => AmosAdmin::t('amosadmin', 'Created by'),
            'updated_by' => AmosAdmin::t('amosadmin', 'Updated by'),
            'deleted_by' => AmosAdmin::t('amosadmin', 'Deleted by'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(\arter\amos\core\user\User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserProfile()
    {
        return $this->hasOne(AmosAdmin::instance()->model('UserProfile'), ['user_id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getContactUserProfile()
    {
        return $this->hasOne(AmosAdmin::instance()->model('UserProfile'), ['user_id' => 'contact_id']);
    }
}
