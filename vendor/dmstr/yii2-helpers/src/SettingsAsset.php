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
 * @copyright Copyright (c) 2017 diemeisterei GmbH, Stuttgart
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace dmstr\helpers;


class SettingsAsset
{
    static public function register($view)
    {
        $bundles = explode(
            "\n",
            \Yii::$app->settings->getOrSet('settingsAssetList', 'app\\assets\\AppAsset', 'app.assets', 'string')
        );

        foreach ($bundles as $bundle) {
            $bundle = trim($bundle);
            // ignore empty lines
            if ($bundle === '') {
                continue;
            }
            if (class_exists($bundle)) {
                $bundle::register($view);
            } else {
                \Yii::warning("Asset bundle '{$bundle}' from settings does not exist");
            }
        }
    }
}