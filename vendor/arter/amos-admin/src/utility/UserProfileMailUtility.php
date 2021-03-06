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
 */

namespace arter\amos\admin\utility;


use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserProfile;
use arter\amos\core\user\User;
use arter\amos\core\utilities\Email;
use arter\amos\admin\models\UserProfileExternalFacilitator;
use arter\amos\workflow\models\WorkflowTransitionsLog;
use yii\helpers\Url;
use yii\log\Logger;


class UserProfileMailUtility
{



    /**
     * @param $to
     * @param $profile
     * @param $subject
     * @param $message
     * @param array $files
     * @return bool
     */
    public static function sendEmailGeneral($to, $profile, $subject, $message, $files = []){
        try {
            $from = '';
            if (isset(\Yii::$app->params['email-assistenza'])) {
                //use default platform email assistance
                $from = \Yii::$app->params['email-assistenza'];
            }

            /** @var \arter\amos\core\utilities\Email $email */
            $email = new Email();
            $email->sendMail($from, $to, $subject, $message, $files);
        } catch (\Exception $ex) {
            //pr($ex->getMessage());
            \Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return true;
    }

    /**
     * @param $model UserProfileExternalFacilitator
     */
    public static function sendEmailRequestEexternalFacilitator($model){
            $profileRequest = $model->userProfile;
            $profileFacilitator = $model->externalFacilitator;

            $userDefault = null;
            $emailsTo = [$profileFacilitator->user->email];
            $link = \Yii::$app->params['platform']['backendUrl'].'/admin/user-profile/view?id='.$profileRequest->id;

            $subject = AmosAdmin::t('amosadmin', 'Sei stato scelto come facilitatore esterno');
            $message =  AmosAdmin::t('amosadmin', "L'utente {nomeCognome} ti ha scelto come Facilitatore Esterno. Vedi il suo <a href='{link}'>profilo utente</a> e decidi se accettare la richiesta", [
                'link' => $link,
                'nomeCognome' => $profileRequest->nomeCognome
            ]);

            self::sendEmailGeneral($emailsTo, null, $subject, $message);
    }

    /**
     * @param $model UserProfileExternalFacilitator
     */
    public static function sendEmailChangeExternalFacilitator($model, $oldFacilitator_id){
        $profileRequest = $model->userProfile;
        $profileFacilitator = $model->externalFacilitator;

        if($oldFacilitator_id){
            $oldFacilitatorProfile = UserProfile::findOne($oldFacilitator_id);
            $userDefault = null;
            $emailsTo = [$oldFacilitatorProfile->user->email];

            $subject = AmosAdmin::t('amosadmin', 'Cambio facilitatore esterno');
            $message =  AmosAdmin::t('amosadmin', "L'utente <strong>{nomeCognome}</strong> ha chiesto di essere facilitato dal Facilitatore <strong>{nomeCognomeFacilitator}</strong>, che ha accettato.<br> Da questo momento non sei pi?? associato a questo utente", [
                'nomeCognome' => $profileRequest->nomeCognome,
                'nomeCognomeFacilitator' => $profileFacilitator->nomeCognome
            ]);

            self::sendEmailGeneral($emailsTo, null, $subject, $message);
        }


    }

    /**
     * @param $model UserProfileExternalFacilitator
     */
    public static function sendEmailAcceptExternalFacilitator($model){
        $profileRequest = $model->userProfile;
        $profileFacilitator = $model->externalFacilitator;

        $userDefault = null;
        $emailsTo = [$profileRequest->user->email];

        $subject = AmosAdmin::t('amosadmin', 'Il facilitatore eterno ha accettato la tua richiesta');
        $message =  AmosAdmin::t('amosadmin', "Il Facilitatore Esterno <strong>{nomeCognome}</strong> ha accettato la tua richiesta.<br> Da questo momento ?? il tuo Facilitatore per i contenuti di piattaforma.", [
            'nomeCognome' => $profileFacilitator->nomeCognome
        ]);

        self::sendEmailGeneral($emailsTo, null, $subject, $message);
    }

    /**
     * @param $model UserProfileExternalFacilitator
     */
    public static function sendEmailRejectExternalFacilitator($model){
        $profileRequest = $model->userProfile;
        $profileFacilitator = $model->externalFacilitator;

        $userDefault = null;
        $emailsTo = [$profileRequest->user->email];

        $subject = AmosAdmin::t('amosadmin', 'Il Facilitatore Esterno non ha accettato la tua richiesta');
        $message =  AmosAdmin::t('amosadmin', "Il Facilitatore Esterno <strong>{nomeCognome}</strong> non ha accettato la tua richiesta.<br> Puoi selezionare un altro Facilitatore Esterno entrando nel tuo profilo utente.", [
            'nomeCognome' => $profileFacilitator->nomeCognome
        ]);

        self::sendEmailGeneral($emailsTo, null, $subject, $message);
    }

    /**
     * @param $model UserProfile
     */
    public static function sendEmailValidationRejected($model){
        $emailsTo = [$model->user->email];
//        $log = WorkflowTransitionsLog::find()
//            ->andWhere(['classname' => 'arter\amos\admin\models\UserProfile', 'owner_primary_key' => $model->user_id])
//            ->andWhere(['end_status' => UserProfile::USERPROFILE_WORKFLOW_STATUS_NOTVALIDATED])
//            ->orderBy('id DESC')->one();

        $validator_user_id = $model->updated_by;
//        if($log){
//            $validator_user_id = $log->created_by;
//        }
        $validatorProfile = User::findOne($validator_user_id);

        $subject = AmosAdmin::t('amosadmin', 'Richiesta di validazione del profilo rifiutata');
        $message =  AmosAdmin::t('amosadmin', "Il Facilitatore di Staff Finlombarda <strong>{nomeCognome}</strong> non ha validato il tuo profilo utente.", [
            'nomeCognome' => $validatorProfile->userProfile->nomeCognome,
        ]);

        if(\Yii::$app->getModule('chat')) {
            $link = \Yii::$app->params['platform']['backendUrl'] . '/messages?contactId=' . $model->updated_by;
            $message .= AmosAdmin::t('amosadmin', "<br> Per maggiori dettagli mettiti in contatto con lui con la messaggistica privata {link}", [
                'link' => $link
            ]);
        }

        self::sendEmailGeneral($emailsTo, null, $subject, $message);
    }

}