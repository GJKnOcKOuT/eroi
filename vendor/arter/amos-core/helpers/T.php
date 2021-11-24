<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\helpers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\helpers;


use Yii;
use yii\base\BaseObject;

class T extends BaseObject
{
    public static $category = '';
    public static $defaultCategory = 'app';
    public static $categorySeparator = '/';

    public static function getCategory()
    {
        if (Yii::$app->controller->module->id) {
            self::$category .= Yii::$app->controller->module->id . self::$categorySeparator;
        }
        if (Yii::$app->controller->id) {
            self::$category .= Yii::$app->controller->id . self::$categorySeparator;
        }
        if (Yii::$app->controller->action->id) {
            self::$category .= Yii::$app->controller->action->id;
        }
        return self::$category;

    }

    public static function tDyn($message, $params = [])
    {
        return Yii::t(self::getCategory(), $message, $params);
    }

    public static function tApp($message, $params = [])
    {
        return Yii::t(self::$defaultCategory, $message, $params);
    }

    public static function t($cat, $message, $params = [])
    {
        return Yii::t($cat, $message, $params);
    }
}