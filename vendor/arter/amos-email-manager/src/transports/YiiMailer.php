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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\emailmanager\transports;

use arter\amos\emailmanager\interfaces\TransportInterface;
use Exception;
use Yii;
use yii\base\Component;
use yii\log\Logger;
use yii\mail\MailerInterface;

class YiiMailer extends Component implements TransportInterface
{

    public function send($from, $to, $subject, $text, $files = [], $bcc = null, $cc = null, $replyTo = null)
    {
        $ret = '';
        try {
            /** @var MailerInterface $mailer */
            $mailer = \Yii::$app->get('mailer');

            if ($mailer != null) {
                $message = $mailer->compose()
                    ->setFrom($this->parseFrom($from))
                    ->setTo($to)
                    ->setSubject($subject)
                    ->setHtmlBody($text);

                if (is_array($bcc) && count($bcc) == 0) {
                    $bcc = null;
                }

                $message->setBcc($bcc);
                $message->setCc($cc);
                $message->setReplyTo($replyTo);

                if (count($files) > 0) {
                    foreach ($files as $file) {
                        //$message->attach($filePath);
                        $message->attachContent($file->content,
                            ['fileName' => $file->name, 'contentType' => $file->type]);
                    }
                }
                try {
                    $ret = $message->send();
                } catch (Exception $ex) {
                    Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
                }

                $mailer->getTransport()->stop();
            }
        } catch (Exception $bex) {
            Yii::getLogger()->log($bex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $ret;
    }

    /**
     * Quick workaround for sender email
     *
     * @param $from
     * @return string|array
     */
    protected function parseFrom($from)
    {
        $parts = explode(' ', $from);

        if (count($parts) == 1) {
            return $from;
        }

        $email = array_shift($parts);
        $name = implode(' ', $parts);
        return [$email => $name];
    }

    /**
     * @param string $string
     * @return array|string
     */
    public function parseRecipients($string)
    {
        $parts = explode(',', $string);
        return $parts;
    }
}