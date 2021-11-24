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
namespace dosamigos\google\maps\layers;


/**
 * WindSpeedUnits
 *
 * @author Antonio Ramirez <amigo.cobos@gmail.com>
 * @link http://www.ramirezcobos.com/
 * @link http://www.2amigos.us/
 * @package dosamigos\google\maps\layers
 */
class WindSpeedUnits
{
    const KILOMETERS_PER_HOUR = 'google.maps.weather.WindSpeedUnit.KILOMETERS_PER_HOUR';
    const METERS_PER_SECOND = 'google.maps.weather.WindSpeedUnit.METERS_PER_SECOND';
    const MILES_PER_HOUR = 'google.maps.weather.WindSpeedUnit.MILES_PER_HOUR';

    /**
     * Checks whether a value is a valid [WindSpeedUnits] constant.
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
                static::KILOMETERS_PER_HOUR,
                static::METERS_PER_SECOND,
                static::MILES_PER_HOUR
            ]
        );
    }
} 