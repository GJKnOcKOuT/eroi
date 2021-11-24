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


namespace arter\amos\emailmanager\controllers\api;

/**
 * This is the class for REST controller "EmailViewController".
 */

use yii\filters\AccessControl;
use yii\helpers\ArrayHelper;
use yii\rest\ActiveController;

class EmailViewController extends ActiveController
{
    public $modelClass = 'arter\amos\emailmanager\models\EmailView';
}
