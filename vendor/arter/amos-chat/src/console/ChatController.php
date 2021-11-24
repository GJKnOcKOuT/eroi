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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\chat\console;

use arter\amos\chat\AmosChat;
use arter\amos\chat\models\Message;
use arter\amos\chat\models\User;
use arter\amos\admin\models\UserProfile;
use Yii;

/**
 * Class ChatController
 * @package arter\amos\chat\console
 */
class ChatController extends \yii\console\Controller
{
    public function actionSendMails()
    {
        $data = Message::find()
            ->addSelect([
                'receiver_id',
                'sender_id',
                "CONCAT(senderUserProfile.nome, ' ', senderUserProfile.cognome) AS senderCompleteName",
                'receiverUser.email AS receiverEmail',
                'COUNT(*) AS msgCount'
            ])
            ->leftJoin(User::tableName() . ' AS receiverUser', 'receiver_id = receiverUser.id')
            ->leftJoin(UserProfile::tableName() . ' AS senderUserProfile', 'sender_id = senderUserProfile.id')
            ->andWhere([
                'is_new' => true,
                'is_deleted_by_receiver' => false
            ])
            ->groupBy(['receiver_id', 'sender_id'])
            ->asArray()->all();

        foreach ($data as $userData) {
            $subject = AmosChat::t('amoschat','Nuovo messaggio su ') . Yii::$app->name;
            Yii::$app->getMailer()
                ->compose(
                    [
                        'html' => '@vendor/arter/amos-chat/src/mail/new-message/html',
                        'text' => '@vendor/arter/amos-chat/src/mail/new-message/text'
                    ], [
                    'userData' => $userData,
                    'subject' => $subject,
                ])
                ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setReplyTo([Yii::$app->params['supportEmail'] => Yii::$app->name])
                ->setTo($userData['receiverEmail'])
                ->setSubject($subject)
                ->send();
        }

        Yii::$app->end();
    }


}
