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

namespace yii\httpclient;

use yii\base\Event;

/**
 * RequestEvent represents the event parameter used for an request events.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0.1
 */
class RequestEvent extends Event
{
    /**
     * @var Request related HTTP request instance.
     */
    public $request;
    /**
     * @var Response|null related HTTP response.
     * This field will be filled only in case some response is already received, e.g. after request is sent.
     */
    public $response;
}