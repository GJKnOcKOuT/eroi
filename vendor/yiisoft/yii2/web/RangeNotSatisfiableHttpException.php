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
 * RangeNotSatisfiableHttpException represents an exception caused by an improper request of the end-user.
 * This exception thrown when the requested range is not satisfiable: the client asked for a portion of
 * the file (byte serving), but the server cannot supply that portion. For example, if the client asked for
 * a part of the file that lies beyond the end of the file.
 *
 * Throwing an RangeNotSatisfiableHttpException like in the following example will result in the error page
 * with error 416 to be displayed.
 *
 * @author Zalatov Alexander <CaHbKa.Z@gmail.com>
 *
 * @since 2.0.11
 */
class RangeNotSatisfiableHttpException extends HttpException
{
    /**
     * Constructor.
     * @param string $message error message
     * @param int $code error code
     * @param \Exception $previous The previous exception used for the exception chaining.
     */
    public function __construct($message = null, $code = 0, \Exception $previous = null)
    {
        parent::__construct(416, $message, $code, $previous);
    }
}
