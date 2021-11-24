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
 * @package    arter\amos\discussioni\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\discussioni\utility;

use arter\amos\discussioni\AmosDiscussioni;
use arter\amos\discussioni\models\DiscussioniTopic;
use yii\base\BaseObject;

/**
 * Class DiscussionsUtility
 * @package arter\amos\discussioni\utility
 */
class DiscussionsUtility extends BaseObject
{
    /**
     * @param DiscussioniTopic $topic
     * @return string
     */
    public static function getViewContributeString($topic)
    {
        $numeroContributi = $topic->getDiscussionComments()->count();
        if ($numeroContributi > 0) {
            $contributesString = $numeroContributi . ' ';
            if ($numeroContributi > 1) {
                $contributesString .= AmosDiscussioni::tHtml('amosdiscussioni', 'contributi');
            } else {
                $contributesString .= AmosDiscussioni::tHtml('amosdiscussioni', 'contributo');
            }
        } else {
            $contributesString = AmosDiscussioni::tHtml('amosdiscussioni', 'Nessun contributo');;
        }
        return $contributesString;
    }
}
