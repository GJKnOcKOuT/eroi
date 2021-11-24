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
 * XingUserPicureSize
 *
 * List of images available in the XING api for a user profile
 */
class XingUserPicureSize
{
    const SIZE_32X32 = 'size_32x32';
    const SIZE_48X48 = 'size_48x48';
    const SIZE_64X64 = 'size_64x64';
    const SIZE_96X96 = 'size_96x96';
    const SIZE_128X128 = 'size_128x128';
    const SIZE_192X192 = 'size_192x192';
    const SIZE_256X256 = 'size_256x256x';
    const SIZE_1024X1024 = 'size_1024x1024';
    const SIZE_ORIGINAL = 'size_original';

    public static function getImageType( $picureSize = null )
    {
        return $picureSize !== null ? $picureSize : self::SIZE_192X192;
    }
}


