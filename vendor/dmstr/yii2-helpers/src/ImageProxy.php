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
 * @link http://www.diemeisterei.de/
 * @copyright Copyright (c) 2018 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\helpers;


/**
 * Class ImageProxy
 * @package dmstr\helpers
 * @author Elias Luhr <e.luhr@herzogkommunikation.de>
 */
class ImageProxy
{

    public static function getFile($imageSource, $preset = null)
    {
        // check if settings components is set
        if (isset(\Yii::$app->settings)) {
            // preset example, when using imageproxy, https://github.com/willnorris/imageproxy#examples
            return \Yii::$app->settings->get('imgBaseUrl', 'app.frontend') .
                $preset .
                \Yii::$app->settings->get('imgHostPrefix', 'app.frontend') .
                $imageSource .
                \Yii::$app->settings->get('imgHostSuffix', 'app.frontend');
        }
        return $imageSource;
    }
}