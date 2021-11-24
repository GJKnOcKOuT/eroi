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

namespace arter\amos\utility\controllers;

use arter\amos\utility\Module;
use yii\filters\AccessControl;
use yii\filters\auth\HttpBearerAuth;
use yii\console\Controller;
use Yii;

class TasksManagerController extends Controller
{
    public function actionIndex()
    {
        echo "Tasks commands:\n";
        echo "\tlist - A list of tasked actions\n";
        echo "\trun  - Execute tasked actions\n";
    }

    public function actionList() {
        echo "None as of now\n";
    }

    public function actionRun() {
        echo "None as of now\n";
    }
}