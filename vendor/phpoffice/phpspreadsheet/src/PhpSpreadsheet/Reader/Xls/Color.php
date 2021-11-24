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


namespace PhpOffice\PhpSpreadsheet\Reader\Xls;

use PhpOffice\PhpSpreadsheet\Reader\Xls;

class Color
{
    /**
     * Read color.
     *
     * @param int $color Indexed color
     * @param array $palette Color palette
     * @param int $version
     *
     * @return array RGB color value, example: ['rgb' => 'FF0000']
     */
    public static function map($color, $palette, $version)
    {
        if ($color <= 0x07 || $color >= 0x40) {
            // special built-in color
            return Color\BuiltIn::lookup($color);
        } elseif (isset($palette, $palette[$color - 8])) {
            // palette color, color index 0x08 maps to pallete index 0
            return $palette[$color - 8];
        }

        // default color table
        if ($version == Xls::XLS_BIFF8) {
            return Color\BIFF8::lookup($color);
        }

        // BIFF5
        return Color\BIFF5::lookup($color);
    }
}
