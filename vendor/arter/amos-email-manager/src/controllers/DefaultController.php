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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\emailmanager\controllers;

use Yii;
use yii\helpers\Url;
use arter\amos\dashboard\controllers\base\DashboardController;


class DefaultController extends DashboardController
{
    public $modelName;
    public $layout = 'dashboard_interna';

    /**
     * @inheritdoc
     */
    public function init()
    {

        parent::init();
        $this->setUpLayout();
        // custom initialization code goes here
    }

    /**
     *
     */
    public function actionIndex($layout = null)
    {
        Url::remember();
        return $this->render('index');
    }

}