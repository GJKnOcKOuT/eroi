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


namespace dmstr\bootstrap;

use yii\web\View;

/**
 * @inheritdoc
 */
class Tabs extends \yii\bootstrap\Tabs
{
    /**
     * Register assetBundle
     */
    public static function registerAssets()
    {
        BootstrapAsset::register(\Yii::$app->controller->getView());
    }

    /**
     * Remember active tab state for this URL
     */
    public static function rememberActiveState()
    {
        self::registerAssets();
        $js = <<<JS
            jQuery("#relation-tabs > li > a").on("click", function () {
                setStorage(this);
            });

            jQuery(document).on('pjax:end', function() {
               setStorage($('#relation-tabs .active A'));
            });

            jQuery(window).on("load", function () {
               initialSelect();
            });
JS;

        if (\Yii::$app->request->isAjax) {
            return "<script type='text/javascript'>{$js}</script>";
        } else {
            // Register cookie script
            \Yii::$app->controller->getView()->registerJs(
                $js,
                View::POS_END,
                'rememberActiveState'
            );
        }
    }

    /**
     * Clear the localStorage of your browser
     */
    public static function clearLocalStorage()
    {
        // TODO @c.stebe - This removes all cookies, eg. the ones set from Yii 2 debug toolbar
        /*\Yii::$app->controller->getView()->registerJs(
            'window.localStorage.clear();',
            View::POS_READY,
            'clearLocalStorage'
        );*/
    }
}
