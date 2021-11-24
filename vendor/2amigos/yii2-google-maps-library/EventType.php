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
 * @copyright Copyright (c) 2014 2amigOS! Consulting Group LLC
 * @link http://2amigos.us
 * @license http://www.opensource.org/licenses/bsd-license.php New BSD License
 */
namespace dosamigos\google\maps;

/**
 * EventType
 *
 * Describes the different valid event types supported.
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps
 */
class EventType
{
    const DEFAULT_EVENT = 'DEFAULT';
    const DEFAULT_ONCE = 'DEFAULT_ONCE';
    const DOM = 'DOM';
    const DOM_ONCE = 'DOM_ONCE';

    /**
     * Checks whether value is a valid [EventType] constant.
     *
     * @param $value
     *
     * @return bool
     */
    public static function getIsValid($value)
    {
        return in_array(
            $value,
            [
                static::DEFAULT_EVENT,
                static::DEFAULT_ONCE,
                static::DOM,
                static::DOM_ONCE
            ]
        );
    }
} 