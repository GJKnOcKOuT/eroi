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

namespace arter\amos\chat\models;

use arter\amos\chat\AmosChat;
use arter\amos\chat\controllers\DefaultController;
use arter\amos\emailmanager\AmosEmail;
use Yii;
use yii\log\Logger;

/**
 * Class Message
 * @package arter\amos\chat\models
 */
class Message extends \arter\amos\chat\models\base\Message
{
    public $userIdForward = [];
    /**
     * @inheritDoc
     */
    public function fields()
    {
        return [
            'messageId' => 'id',
            'senderId' => 'sender_id',
            'text',
            'date' => function ($model) {
                return static::formatDate($model['created_at'])[1];
            },
            'when' => function ($model) {
                return static::formatDate($model['created_at'])[0];
            },
        ];
    }

    /**
     * @param $value
     * @return array
     */
    public static function formatDate($value)
    {
        $today = date_create()->setTime(0, 0, 0);
        $date = date_create($value)->setTime(0, 0, 0);
        if ($today == $date) {
            $label = AmosChat::tHtml('amoschat', 'Oggi');
        } elseif ($today->getTimestamp() - $date->getTimestamp() == 24 * 60 * 60) {
            $label = AmosChat::tHtml('amoschat', 'Ieri');
        } elseif ($today->format('W') == $date->format('W') && $today->format('Y') == $date->format('Y')) {
            $label = Yii::$app->formatter->asDate($value, 'php:l');
        } elseif ($today->format('Y') == $date->format('Y')) {
            $label = Yii::$app->formatter->asDate($value, 'php:d F');
        } else {
            $label = Yii::$app->formatter->asDate($value, 'medium');
        }
        $formatted = Yii::$app->formatter->asTime($value, 'short');
        return [$label, $formatted];
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        try {
            /** @var AmosChat $module */
            $module = Yii::$app->getModule('chat');

            if (!empty($module) && isset($module->immediateNotificationForce) && ($module->immediateNotificationForce == true)) {
                $from = '';
                if (isset(Yii::$app->params['email-assistenza'])) {
                    //use default platform email assistance
                    $from = Yii::$app->params['email-assistenza'];
                }
                $sender = User::findOne($this->sender_id);
                $senderProfile = $sender->profile;
                $subject = AmosChat::t('amoschat', 'You received a new private message');

                /** @var DefaultController $controller */
                $controller = new DefaultController('default', $module);
                $text = $controller->renderMailPartial('@vendor/arter/amos-chat/src/views/default/email', [
                    'message' => $this,
                    'contactProfile' => $senderProfile
                ], $this->receiver_id);

                $mailModule = Yii::$app->getModule('email');
                if (!is_null($mailModule)) {

                    /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
                    $mailModule->send(
                        (!empty($module->defaultEmailSender)? $module->defaultEmailSender : (!empty($from) ? $from : $sender->email)),
                        User::findOne($this->receiver_id)->email,
                        $subject,
                        $text
                    );
                }
            }
        } catch (\Exception $exception) {
            Yii::getLogger()->log($exception->getMessage(), Logger::LEVEL_ERROR);
        }
        parent::afterSave($insert, $changedAttributes);
    }

}