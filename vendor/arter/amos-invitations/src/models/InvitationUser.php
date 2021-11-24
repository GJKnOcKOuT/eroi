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
 * @package    arter\amos\invitations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\invitations\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * @property integer numberNotificationSended
 * @property integer numberNotificationSendedByMe
 * This is the model class for table "invitation_user".
 */
class InvitationUser extends \arter\amos\invitations\models\base\InvitationUser
{
    public static function getEditFields()
    {
        $labels = self::attributeLabels();

        return [
            [
                'slug' => 'email',
                'label' => $labels['email'],
                'type' => 'string'
            ],
        ];
    }

    public function attributeLabels()
    {
        return
            ArrayHelper::merge(
                parent::attributeLabels(),
                [
                    'numberNotificationSended' => Yii::t('amosinvitations', 'Number of invitation to ths email'),
                    'numberNotificationSendedByMe' => Yii::t('amosinvitations', 'Number of invitation to ths email by me')
                ]);
    }

    public function representingColumn()
    {
        return [
            //inserire il campo o i campi rappresentativi del modulo
        ];
    }

    /**
     * Returns the text hint for the specified attribute.
     * @param string $attribute the attribute name
     * @return string the attribute hint
     * @see attributeHints
     */
    public function getAttributeHint($attribute)
    {
        $hints = $this->attributeHints();
        return isset($hints[$attribute]) ? $hints[$attribute] : null;
    }

    public function attributeHints()
    {
        return [
        ];
    }

    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
        ]);
    }


    public function getNumberNotificationSended(){
        if (!empty($this->id)) {
            return self::numberNotificationsSended($this->id);
        } else {
            return 0;
        }
    }

    public function getNumberNotificationSendedByMe(){
        if (!empty($this->id)) {
            return self::numberNotificationsSendedByUserId($this->id, Yii::$app->user->id);
        } else {
            return 0;
        }
    }

    public static function getInvitationUserFromEmail($email)
    {
        return self::find()->andWhere(['email' => $email])->one();
    }

    /**
     * @param $invitationUserId
     * @return int
     */
    public static function numberNotificationsSended($invitationUserId = null){
        $invitationUser = self::findOne($invitationUserId);
        if (!empty($invitationUser)) {
            return count(Invitation::find()->andWhere(['invitation_user_id' => $invitationUserId, 'send' => true])->all());
        } else {
            return 0;
        }
    }

    /**
     * @param $invitationUserId
     * @param null $userId
     * @return int
     */
    public static function numberNotificationsSendedByUserId($invitationUserId = null, $userId = null){
        $invitationUser = self::findOne($invitationUserId);
        if (!empty($invitationUser)) {
            return count(Invitation::find()->andWhere([
                'invitation_user_id' => $invitationUserId,
                'send' => true,
                'created_by' => $userId,
                ])->all());
        } else {
            return 0;
        }
    }

}
