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


namespace arter\amos\core\utilities;

use arter\amos\core\utilities\Email;
use arter\amos\core\user\User;
use Yii;

class ViewUtility {

    /**
     * 
     */
    public static function formatDateTime() {
        return (isset(Yii::$app->modules['datecontrol']['displaySettings']['datetime'])) 
            ? Yii::$app->modules['datecontrol']['displaySettings']['datetime'] 
            : 'd-m-Y H:i:s A';
    }

    /**
     * 
     * @return type
     */
    public static function formatDate() {
        return (isset(Yii::$app->modules['datecontrol']['displaySettings']['date'])) 
            ? Yii::$app->modules['datecontrol']['displaySettings']['date'] 
            : 'd-m-Y';
    }

}
