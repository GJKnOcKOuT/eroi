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
 * @package    arter\amos\comments\components
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comments\components;

use yii\base\Event;

/**
 * Interface CommentComponentInterface
 * @package arter\amos\comments\components
 */
interface CommentComponentInterface
{
    /**
     * Method that enable the comments on a specific model.
     * @param \yii\base\Event $event
     */
    public function showComments(Event $event);
}
