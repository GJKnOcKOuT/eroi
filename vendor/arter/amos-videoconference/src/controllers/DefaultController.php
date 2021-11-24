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
 * @package    arter\amos\videoconference\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\videoconference\controllers;

use arter\amos\dashboard\controllers\base\DashboardController;
use Yii;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\filters\AccessControl;

class DefaultController extends DashboardController {

    /**
     * @var string $layout Layout per la dashboard interna.
     */
    public $layout = "@vendor/arter/amos-core/views/layouts/dashboard_interna";
    
    
    /**
     * Lists all Videoconference models.
     * @return mixed
     */
    public function actionIndex() {
        return $this->redirect(['/videoconference/videoconf/index']);

       /* Url::remember();

        $params = [
            'currentDashboard' => $this->getCurrentDashboard()
        ];

        return $this->render('index', $params);*/
       
    }

}
