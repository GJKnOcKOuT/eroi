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
 * @package    arter\amos\invitations\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\invitations\models;

use arter\amos\invitations\Module;
use yii\base\Model;

/**
 * Class GoogleInvitationForm
 * @package arter\amos\invitations\models
 */
class GoogleInvitationForm extends Model
{
    public $selection = [];

    public $message = '';

    public $search;

    public function rules()
    {
        return [
            [['selection', 'message'], 'required'],
            ['selection', 'safe'],
            [['message', 'search'], 'string'],
            ['message', \arter\amos\core\validators\StringHtmlValidator::className(), 'max' => 2500],

        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'message' => Module::t('amosinvitations', 'Message'),
            'selection' => Module::t('amosinvitations', '#selected_contacts'),
            'search' => Module::t('amosinvitations', 'Search name or email'),
        ];
    }

}
