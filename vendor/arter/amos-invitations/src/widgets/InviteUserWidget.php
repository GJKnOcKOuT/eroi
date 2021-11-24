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
 * @package    arter\amos\invitations\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\invitations\widgets;

use arter\amos\core\helpers\Html;
use arter\amos\invitations\models\Invitation;
use arter\amos\invitations\models\InvitationForm;
use arter\amos\invitations\models\InvitationUser;
use arter\amos\invitations\Module;
use yii\helpers\ArrayHelper;

/**
 * Class InviteUserWidget
 * @package arter\amos\invitations\widgets
 */
class InviteUserWidget extends \yii\base\Widget
{

    public $btnOptions = [];

    public $btnLabel;

    public $layout = '{invitationBtn}{invitationModalForm}';

    public function run()
    {
        $content = preg_replace_callback("/{\\w+}/", function ($matches) {
            $content = $this->renderSection($matches[0]);

            return $content === false ? $matches[0] : $content;
        }, $this->layout);

        return $content;
    }

    /**
     * @inheritdoc
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{invitationBtn}':
                return $this->renderInvitationBtn();
            case '{invitationModalForm}':
                return $this->renderInvitationModalForm();
            default:
                return false;
        }
    }

    public function renderInvitationBtn()
    {
        if(is_null($this->btnLabel)){
            $this->btnLabel = Module::t('amosinvitations', '#new_invitation_btn');
        }
        $btnOptions = ArrayHelper::merge( [
            'class' => 'btn btn-administration-primary',
            'data-target' => '#invite-new-user-modal',
            'data-toggle' => 'modal'
        ], $this->btnOptions);

        $btn = Html::a($this->btnLabel,
            null,
            $btnOptions
        ) ;

        return $btn;

    }

    public function renderInvitationModalForm()
    {
         return $this->render('invite-user', ['invitation' => new Invitation(), 'invitationUser' => new InvitationUser()]);
    }


}