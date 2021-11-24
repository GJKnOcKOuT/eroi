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
 * UnsupportedMediaTypeHttpException represents an "Unsupported Media Type" HTTP exception with status code 415.
 *
 * Use this exception when the client sends data in a format that your
 * application does not understand. For example, you would throw this exception
 * if the client POSTs XML data to an action or controller that only accepts
 * JSON.
 *
 * @see https://tools.ietf.org/html/rfc7231#section-6.5.13
 * @author Dan Schmidt <danschmidt5189@gmail.com>
 * @since 2.0
 */
class UnsupportedMediaTypeHttpException extends HttpException
{
    /**
     * Constructor.
     * @param string $message error message
     * @param int $code error code
     * @param \Exception $previous The previous exception used for the exception chaining.
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(415, $message, $code, $previous);
    }
}
