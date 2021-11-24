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


namespace PhpOffice\PhpSpreadsheet\Shared;

use DateTimeZone;
use PhpOffice\PhpSpreadsheet\Exception as PhpSpreadsheetException;

class TimeZone
{
    /**
     * Default Timezone used for date/time conversions.
     *
     * @var string
     */
    protected static $timezone = 'UTC';

    /**
     * Validate a Timezone name.
     *
     * @param string $timezone Time zone (e.g. 'Europe/London')
     *
     * @return bool Success or failure
     */
    private static function validateTimeZone($timezone)
    {
        return in_array($timezone, DateTimeZone::listIdentifiers());
    }

    /**
     * Set the Default Timezone used for date/time conversions.
     *
     * @param string $timezone Time zone (e.g. 'Europe/London')
     *
     * @return bool Success or failure
     */
    public static function setTimeZone($timezone)
    {
        if (self::validateTimezone($timezone)) {
            self::$timezone = $timezone;

            return true;
        }

        return false;
    }

    /**
     * Return the Default Timezone used for date/time conversions.
     *
     * @return string Timezone (e.g. 'Europe/London')
     */
    public static function getTimeZone()
    {
        return self::$timezone;
    }

    /**
     *    Return the Timezone offset used for date/time conversions to/from UST
     * This requires both the timezone and the calculated date/time to allow for local DST.
     *
     * @param string $timezone The timezone for finding the adjustment to UST
     * @param int $timestamp PHP date/time value
     *
     * @throws PhpSpreadsheetException
     *
     * @return int Number of seconds for timezone adjustment
     */
    public static function getTimeZoneAdjustment($timezone, $timestamp)
    {
        if ($timezone !== null) {
            if (!self::validateTimezone($timezone)) {
                throw new PhpSpreadsheetException('Invalid timezone ' . $timezone);
            }
        } else {
            $timezone = self::$timezone;
        }

        if ($timezone == 'UST') {
            return 0;
        }

        $objTimezone = new DateTimeZone($timezone);
        $transitions = $objTimezone->getTransitions($timestamp, $timestamp);

        return (count($transitions) > 0) ? $transitions[0]['offset'] : 0;
    }
}
