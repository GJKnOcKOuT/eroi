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

use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * @property boolean alreadySended
 * @property string nameSurname
 * This is the model class for table "invitation".
 */
class Invitation extends \arter\amos\invitations\models\base\Invitation
{

    public static function getEditFields()
    {
        $labels = self::attributeLabels();

        return [
            [
                'slug' => 'name',
                'label' => $labels['name'],
                'type' => 'string'
            ],
            [
                'slug' => 'surname',
                'label' => $labels['surname'],
                'type' => 'string'
            ],
            [
                'slug' => 'message',
                'label' => $labels['message'],
                'type' => 'text'
            ],
            [
                'slug' => 'send_time',
                'label' => $labels['send_time'],
                'type' => 'datetime'
            ],
            [
                'slug' => 'send',
                'label' => $labels['send'],
                'type' => 'smallint'
            ],
            [
                'slug' => 'invitation_user_id',
                'label' => $labels['invitation_user_id'],
                'type' => 'integer'
            ],
        ];
    }

    public function attributeLabels()
    {
        return
            ArrayHelper::merge(
                parent::attributeLabels(),
                [
                ]);
    }

    public function representingColumn()
    {
        return $this->getNameSurname();
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

    public function getNameSurname(){
        return $this->name . ' ' . $this->surname;
    }

    public function getAlreadySended(){
        if (!empty($this->invitationUser)) {
            return self::alreadySended($this->invitationUser->email);
        } else {
            return false;
        }
    }

    /**
     * @param $email
     * @return bool
     */
    public static function alreadySended($email){
        /** @var ActiveQuery $query */
        $query = InvitationUser::find();
        $invitationUser = $query->joinWith('invitations')->andWhere(['invitation_user.email' => $email, 'invitation.send' => 1])->one();
        if (empty($invitationUser)) {
            return false;
        } else {
            return true;
        }
    }

}
