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
 * @package    arter\amos\notificationmanager\controllers
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\notificationmanager\controllers;

use arter\amos\dashboard\controllers\base\DashboardController;

/**
 * Class DefaultController
 * @package arter\amos\notificationmanager\controllers
 */
class DefaultController extends DashboardController
{
    /**
     * @var string $layout Layout per la dashboard interna.
     */
    public $layout = "dashboard_interna";
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->setUpLayout();
    }
    
    /**
     * Lists all models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->redirect('/notify/newsletter/index');
    }
}
