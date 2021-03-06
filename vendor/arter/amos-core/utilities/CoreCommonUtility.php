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
 * @package    arter\amos\core\utilities
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\utilities;

use arter\amos\core\migration\libs\common\MigrationCommon;
use yii\log\Logger;

/**
 * Class CoreCommonUtility
 * @package arter\amos\core\utilities
 */
class CoreCommonUtility
{
    /**
     * This method is useful to check if the user is viewing a platform from headquarter or from another place.
     * Useful to enable offline mode only for other places, see login standard form from only main headquarter
     * or other functionalities. It return true if the user is in main headquarter. False otherwise.
     * @return bool
     */
    public static function platformSeenFromHeadquarter()
    {
        return (
            isset(\Yii::$app->params['seeLoginFormAllowedIps']) &&
            is_array(\Yii::$app->params['seeLoginFormAllowedIps']) &&
            !empty(\Yii::$app->params['seeLoginFormAllowedIps']) &&
            in_array($_SERVER['REMOTE_ADDR'], \Yii::$app->params['seeLoginFormAllowedIps'])
        );
    }
    
    /**
     * This method add an error message for each type of application, console or web.
     * @param string $errorMsg
     */
    public static function printErrorMessage($errorMsg)
    {
        if (\Yii::$app instanceof \yii\web\Application) {
            \Yii::$app->getSession()->addFlash('danger', $errorMsg);
        } elseif (\Yii::$app instanceof \yii\console\Application) {
            MigrationCommon::printConsoleMessage($errorMsg);
        } else {
            \Yii::getLogger()->log($errorMsg, Logger::LEVEL_ERROR);
        }
    }
}
