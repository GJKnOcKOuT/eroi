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
 */
namespace schmunk42\giiant\generators\crud\callbacks\yii;

class Db
{
    public static function falseIfText()
    {
        // hide text columns (dbType: text)
        return function ($attribute, $model, $generator) {
            $column = $generator->getColumnByAttribute($attribute);

            if (!$column) {
                return;
            }

            switch ($column->dbType) {
                case 'tinytext':
                case 'text':
                case 'mediumtext':
                case 'longtext':
                    return false;
            }
        };
    }

    public static function falseIfAutoIncrement()
    {
        // hide AI columns
        return function ($attribute, $model, $generator) {
            $column = $generator->getColumnByAttribute($attribute);
            if (!$column) {
                return;
            }

            if ($column->autoIncrement) {
                return false;
            }
        };
    }
}
