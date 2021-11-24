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

use yii\base\Exception;

/**
 * HeadersAlreadySentException represents an exception caused by
 * any headers that were already sent before web response was sent.
 *
 * @author Dmitry Dorogin <dmirogin@ya.ru>
 * @since 2.0.14
 */
class HeadersAlreadySentException extends Exception
{
    /**
     * {@inheritdoc}
     */
    public function __construct($file, $line)
    {
        $message = YII_DEBUG ? "Headers already sent in {$file} on line {$line}." : 'Headers already sent.';
        parent::__construct($message);
    }
}
