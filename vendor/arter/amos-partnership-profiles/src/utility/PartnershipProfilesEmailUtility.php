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
 * @package    arter\amos\partnershipprofiles\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\utility;

use arter\amos\core\utilities\Email;
use yii\base\BaseObject;

/**
 * Class PartnershipProfilesEmailUtility
 * @package arter\amos\partnershipprofiles\utility
 */
class PartnershipProfilesEmailUtility extends BaseObject
{
    /**
     * @param string $from
     * @param array $tos
     * @param string $subject
     * @param string $text
     * @param array $files
     * @param array $bcc
     * @param array $params
     * @return bool
     */
    public static function sendMail($from, $tos, $subject, $text, $files = [], $bcc = [])
    {
        $ok = true;
        /** @var \arter\amos\emailmanager\AmosEmail $mailModule */
        $mailModule = \Yii::$app->getModule('email');
        if (isset($mailModule)) {
            if (is_null($from)) {
                if (isset(\Yii::$app->params['email-assistenza'])) {
                    // Use default platform email assistance
                    $from = \Yii::$app->params['email-assistenza'];
                } else {
                    $from = 'assistenza@arter.it';
                }
            }
            $ok = Email::sendMail($from, $tos, $subject, $text, $files, $bcc, [], 0, false);
        }
        return $ok;
    }
}
