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

namespace yii\web;

/**
 * GoneHttpException represents a "Gone" HTTP exception with status code 410.
 *
 * Throw a GoneHttpException when a user requests a resource that no longer exists
 * at the requested url. For example, after a record is deleted, future requests
 * for that record should return a 410 GoneHttpException instead of a 404
 * [[NotFoundHttpException]].
 *
 * @see https://tools.ietf.org/html/rfc7231#section-6.5.9
 * @author Dan Schmidt <danschmidt5189@gmail.com>
 * @since 2.0
 */
class GoneHttpException extends HttpException
{
    /**
     * Constructor.
     * @param string $message error message
     * @param int $code error code
     * @param \Exception $previous The previous exception used for the exception chaining.
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(410, $message, $code, $previous);
    }
}
