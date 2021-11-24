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
 * @package    arter\amos\events\events
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\events\events;

use arter\amos\community\models\CommunityUserMm;
use arter\amos\core\controllers\CrudController;
use arter\amos\core\user\User;
use arter\amos\core\utilities\Email;
use Yii;
use yii\base\Event;
use yii\helpers\ArrayHelper;

/**
 * Class EventsWorkflowEvent
 * @package arter\amos\events\events
 */
class EventsWorkflowEvent
{
    /**
     * @param Event $yiiEvent
     * @return bool
     */
    public function sendValidationRequest(Event $yiiEvent)
    {
        /** @var \arter\amos\events\models\Event $event */
        $event = $yiiEvent->data;
        if (is_null($event->community_id)) {
            return true;
        }

        // Default email values
        $from = User::findOne(Yii::$app->getUser()->id)->email;
        $to = [];
        $subject = null;
        $text = null;
        $files = [];
        $bcc = [];
        $params = null;
        $priority = 0;
        $use_queue = true;

        $user = User::findOne($event->created_by);

        // Populate TO
        if(!empty($event->validatori)) {
            $validatori = [];
            if(!is_array($event->validatori)){
                $validatori[$event->validatori] = $event->validatori;
            }
            else {
                $validatori = $event->validatori;
            }
            foreach ($validatori as $key => $value) {
                $pos = strrpos($value, 'user');
                if ($pos !== false) { // Found USER VALIDATOR
                    $userId = str_replace('user-', '', $value);
                    $user = User::findOne($userId);
                    $to[] = $user->email;
                } else {
                    $pos = strrpos($value, 'community');
                    if ($pos !== false) { // Found COMMUNITY VALIDATOR
                        $commuityId = str_replace('community-', '', $value); // TODO In the future could be useful
                        $communityUserMm = new CommunityUserMm();
                        $tmp = $communityUserMm->getCommunityManagerMailList($event->community_id);
                        $to = ArrayHelper::merge($to, $tmp);
                    }
                }
            }
        }

        /** @var CrudController $controller */
        $controller = \Yii::$app->controller;
        $vendorAlias = Yii::getAlias('@vendor');
        $controller->setViewPath($vendorAlias . DIRECTORY_SEPARATOR .
            'arter' . DIRECTORY_SEPARATOR .
            'amos-events' . DIRECTORY_SEPARATOR .
            'src' . DIRECTORY_SEPARATOR .
            'views' . DIRECTORY_SEPARATOR .
            'email');


        // Populate SUBJECT
        $subject = $controller->renderMailPartial(
            'validation_request_subject',
            [
                'event' => $event
            ]
        );

        // Populate TEXT
        $text = $controller->renderMailPartial(
            'validation_request_text',
            [
                'event' => $event,
                'user' => $user
            ]
        );

        // Populate BCC
        $bcc[] = User::findOne(Yii::$app->getUser()->id)->email;

        // Populate PARAMS
        /* NOT YET IMPLEMENTED, RESERVED FOR FUTURE USE */

        // SEND EMAIL
        $ok = Email::sendMail(
            $from,
            $to,
            $subject,
            $text,
            $files,
            $bcc,
            $params,
            $priority,
            $use_queue
        );

        return $ok;
    }

    /**
     * @param Event $yiiEvent
     * @return bool
     */
    public function eventPublicationOperations(Event $yiiEvent)
    {
        /** @var \arter\amos\events\models\Event $event */
        $event = $yiiEvent->data;
        if (is_null($event)) {
            return false;
        }

        $loggedUser = User::findOne(Yii::$app->getUser()->getId());
        if (is_null($loggedUser)) {
            return false;
        }

        $creatorUser = User::findOne($event->created_by);
        if (is_null($creatorUser)) {
            return false;
        }

        /** @var CrudController $controller */
        $controller = \Yii::$app->controller;

        $vendorAlias = Yii::getAlias('@vendor');
        $controller->setViewPath($vendorAlias . DIRECTORY_SEPARATOR .
            'arter' . DIRECTORY_SEPARATOR .
            'amos-events' . DIRECTORY_SEPARATOR .
            'src' . DIRECTORY_SEPARATOR .
            'views' . DIRECTORY_SEPARATOR .
            'email');

        // Populate SUBJECT
        $subject = $controller->renderMailPartial(
            'publication_subject'
        );

        // Populate TEXT
        $text = $controller->renderMailPartial(
            'publication_text',
            [
                'event' => $event
            ]
        );

        $from = $loggedUser->email;
        $to = [$creatorUser->email];
        $files = [];
        $bcc = [$loggedUser->email];
        $params = null;
        $priority = 0;
        $use_queue = true;

        $ok = Email::sendMail(
            $from,
            $to,
            $subject,
            $text,
            $files,
            $bcc,
            $params,
            $priority,
            $use_queue
        );

        return $ok;
    }
}
