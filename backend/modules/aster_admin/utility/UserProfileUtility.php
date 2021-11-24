<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\modules\aster_admin\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\modules\aster_admin\utility;

use arter\amos\admin\base\ConfigurationManager;
use arter\amos\admin\models\UserContact;
use arter\amos\admin\AmosAdmin;
use arter\amos\core\utilities\Email;
use Yii;

/**
 * Class UserProfileUtility
 * @package backend\modules\aster_admin\utility
 */
class UserProfileUtility extends \arter\amos\admin\utility\UserProfileUtility {

    /**
     * @param $useprofile
     * @throws \Exception
     */
    public static function updateUserProfileOnChangeMentor($useprofile) {
        $facilitatore = $useprofile->facilitatore;
        $module = \Yii::$app->getModule('admin');
        if ($module->confManager->isVisibleBox('box_facilitatori', ConfigurationManager::VIEW_TYPE_FORM) && $module->confManager->isVisibleField('facilitatore_id', ConfigurationManager::VIEW_TYPE_FORM) && !is_null($facilitatore) && $facilitatore->user_id != $useprofile->user_id && ($useprofile->validato_almeno_una_volta == 1 || ($useprofile->validato_almeno_una_volta == 0 && $useprofile->status != \arter\amos\admin\models\UserProfile::USERPROFILE_WORKFLOW_STATUS_DRAFT))) {

            $userContact = UserContact::findOne(['user_id' => $useprofile->user_id, 'contact_id' => $facilitatore->user_id]);

            if (is_null($userContact)) {
                $userContact = UserContact::findOne(['user_id' => $facilitatore->user_id, 'contact_id' => $useprofile->user_id]);
                if (is_null($userContact)) {
                    //if there is no connection between $userId and $contactId create a new userContact
                    $userContact = new UserContact();
                    $userContact->user_id = $useprofile->user_id;
                    $userContact->contact_id = $facilitatore->user_id;
                    $userContact->created_by = $facilitatore->user_id;
                }
            }
            $userContact->status = UserContact::STATUS_ACCEPTED;
            if ($userContact->save(false)) {
                self::sendEmailImyourFacilitator($facilitatore, $useprofile);
            } else {
                throw new \Exception(AmosAdmin::t('amosadmin', "Error during the save user contact "));
            }
        }
    }

    /**
     * @param $facilitatore
     */
    public static function sendEmailImyourFacilitator($facilitatore, $useprofile) {
        $tos = [$facilitatore->user->email];

        $message = AmosAdmin::t('amosadmin', "#facilitator_assigned", ['nomecognome' => $useprofile->getNomeCognome()]);
        $subject = AmosAdmin::t('amosadmin', "#facilitator_assigned_obj");
        $messageLink = AmosAdmin::t('amosadmin', 'to accept or refuse the invitation');

        $text = Email::renderMailPartial('@vendor/arter/amos-admin/src/views/user-profile/email', [
                    'contactProfile' => $useprofile,
                    'message' => $message,
        ]);

        /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
        $from = null;
        // controllo se esiste il controller perchè quando crea il timestamp del login il controller non esiste
        if (!empty(\Yii::$app->controller)) {
            $mailModule = Yii::$app->getModule("email");
            if (isset($mailModule)) {
                if (is_null($from)) {
                    if (isset(Yii::$app->params['email-assistenza'])) {
                        //use default platform email assistance
                        $from = Yii::$app->params['email-assistenza'];
                    } else {
                        $from = 'noreply@emiliaromagnaopeninnovation.aster.it Piattaforma Open Innovation Emilia-Romagna';
                    }
                }
                return Email::sendMail($from, $tos, $subject, $text, [], [], [], 0, false);
            }
        }
        return false;
    }

    /**
     * @param $model
     * @param $enable
     * @param $role
     * @throws \Exception
     */
    public static function enableDisableRole($model, $enable, $role) {
        $authManager = \Yii::$app->authManager;
        $roleobj = $authManager->getRole($role);
        if ($enable) {

            if (!$authManager->checkAccess($model->user_id, $role)) {
                $authManager->assign($roleobj, $model->user_id);
            }
        } else {
            if ($authManager->checkAccess($model->user_id, $role)) {
                $authManager->revoke($roleobj, $model->user_id);
            }
        }
        $authManager->invalidateCache();
    }

}
