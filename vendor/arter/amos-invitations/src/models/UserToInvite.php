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
 * @package    UserToInvite.php
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\invitations\models;


use arter\amos\invitations\Module;
use yii\base\Model;

/**
 * Class UserToInvite
 * @package arter\amos\invitations\models
 */
class UserToInvite extends Model
{

    public $name = '';

    public $surname = '';

    public $displayName = '';

    public $email = '';

    public $photoUrl = '';

    public $selected = false;

    public $sentInvitations = 0;

    public $invitationUserId;

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'name' => Module::t('amosinvitations', 'Name'),
            'surname' => Module::t('amosinvitations', 'Surname'),
            'displayName' => Module::t('amosinvitations', 'Name'),
            'email' => Module::t('amosinvitations', 'Email'),
            'photoUrl' => Module::t('amosinvitations', 'Image'),
            'sentInvitations' => Module::t('amosinvitations', 'Sent Invitations'),
        ];
    }

}
