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
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\mail;

use yii\base\Event;

/**
 * MailEvent represents the event parameter used for events triggered by [[BaseMailer]].
 *
 * By setting the [[isValid]] property, one may control whether to continue running the action.
 *
 * @author Mark Jebri <mark.github@yandex.ru>
 * @since 2.0
 */
class MailEvent extends Event
{
    /**
     * @var \yii\mail\MessageInterface the mail message being send.
     */
    public $message;
    /**
     * @var bool if message was sent successfully.
     */
    public $isSuccessful;
    /**
     * @var bool whether to continue sending an email. Event handlers of
     * [[\yii\mail\BaseMailer::EVENT_BEFORE_SEND]] may set this property to decide whether
     * to continue send or not.
     */
    public $isValid = true;
}
