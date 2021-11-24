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

namespace arter\amos\translation\utility;

/**
 * Class TranslationUtility
 * @package arter\amos\translation\utility
 */
class TranslationUtility
{
    public static function getAttributesToTranslate($namespace){
        $module = \Yii::$app->getModule('translation');
        $attributesToTranslate = [];

        if($module) {
            $models = (!empty($module->translationBootstrap['configuration']['translationContents']['models']) ?
                $module->translationBootstrap['configuration']['translationContents']['models']
                : []);

            foreach ((array)$models as $value) {
                if ($value['namespace'] == $namespace) {
                    $attributesToTranslate = $value['attributes'];
                }
            }
        }
        return $attributesToTranslate;
    }
}