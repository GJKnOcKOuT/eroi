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

namespace arter\amos\admin\events;


use arter\amos\admin\AmosAdmin;
use arter\amos\admin\models\UserContact;
use arter\amos\admin\models\UserProfile;
use arter\amos\chat\models\Message;
use arter\amos\core\utilities\Email;
use Yii;
use yii\base\Event;
use yii\base\Exception;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * Class CorsiRichiesteRettificaWorkflowEvent
 * @package backend\modules\corsi\events\worflow
 */
class AssociateTutorToUserEvent
{

    /**
     *  Associate user TUTOR to the created users
     * @param Event $event
     */
    public function afterCreateUser(Event $event)
    {
        $adminModule = AmosAdmin::instance();
        if($adminModule && !empty($adminModule->associateTutor)) {
            /** @var $userProfile UserProfile */
            $userProfile = $event->data;
            $userContact = new UserContact([
                'user_id' => $userProfile->user_id,
                'contact_id' => $adminModule->associateTutor, // 197 user TUTOR
                'status' => 'ACCEPTED',
                'accepted_at' => $userProfile->created_at,
            ]);

            $userContact->save();

            $chatModule = \Yii::$app->getModule('chat');

            if($chatModule && $adminModule->defaultPrivateMessage) {
                $tutorProfile = UserProfile::findOne($adminModule->associateTutor);

                $link = '';
                if(!empty($adminModule->helpLinkAction)) {
                    $link = $adminModule->helpLinkAction;
                }

                $bodyMessage = Yii::t('amosadmin', '#new_user_default_message_v2', [
                    'user_name_surname' => $userProfile->getNomeCognome(),
                    'platform_name' => Yii::$app->name,
                    'latest_news_link' => \Yii::$app->params['platform']['backendUrl'].'/news/news/own-interest-news',
                    'help_link' => \Yii::$app->params['platform']['backendUrl'] . $link,
                    'sender_name' => $tutorProfile->nome,
                ]);
                $subjectMessage = Yii::t('amosadmin', '#new_user_default_message_v2_subject');

                // The first private message is sent without using the model-create-save behaviour to avoid
                // sending an email automatically after the message creation.

                Email::sendMail(Yii::$app->params['supportEmail'], [$userProfile->user->email], $subjectMessage, <<<HTML
                    <h3 align="center">{$subjectMessage}</h3><hr /><br />
                    {$bodyMessage}
HTML
                );

                \Yii::$app->db->createCommand()->insert(Message::tableName(), [
                    'sender_id' => $adminModule->associateTutor,
                    'receiver_id' => $userProfile->user_id,
                    'text' => $bodyMessage,
                    'is_new' => true,
                    'created_at' => date('Y-m-d H:m:s'),
                    'updated_at' => date('Y-m-d H:m:s'),
                    'created_by' => $adminModule->associateTutor,
                    'updated_by' => $adminModule->associateTutor,
                ])->execute();

            }
        }
        return true;
    }





}