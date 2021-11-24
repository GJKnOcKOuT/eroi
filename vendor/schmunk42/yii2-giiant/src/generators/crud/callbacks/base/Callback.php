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


namespace schmunk42\giiant\generators\crud\callbacks\base;

class Callback
{
    /**
     * @return \Closure no output, returns false to end to provider queue
     */
    public static function false()
    {
        return function () {
            return false;
        };
    }

    /**
     * @return \Closure standard attribute, without any formatting
     */
    public static function attribute()
    {
        return function ($attribute) {
            return "'$attribute'";
        };
    }

    /**
     * @return \Closure standard field from yii2-gii generator
     */
    public static function field()
    {
        return function ($attribute, $model, $generator) {
            return $generator->generateActiveField("$attribute");
        };
    }

    /**
     * @return \Closure standard column, without any formatting
     */
    public static function column()
    {
        return function ($attribute) {
            return "'$attribute'";
        };
    }
}
