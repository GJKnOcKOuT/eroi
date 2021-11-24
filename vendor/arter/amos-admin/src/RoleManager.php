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
 * @package    arter\amos\admin
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin;

use mdm\admin\Module;
use Yii;
use yii\base\Exception;
use yii\web\ForbiddenHttpException;

/**
 * Class AmosAdmin
 * @package arter\amos\admin
 */
class RoleManager extends Module
{
    public $controllerNamespace = "mdm\admin\controllers";
    public function init()
    {
        //Views on the original plugin
        $this->viewPath = '@vendor/mdmsoft/yii2-admin/views';

        if(!Yii::$app->user->can('ADMIN')) {
            throw new ForbiddenHttpException(Yii::t('amosadmin', 'Access Denied'));
        }

        return parent::init();
    }
}
