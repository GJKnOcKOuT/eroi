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

use arter\amos\core\controllers\BackendController;
use yii\filters\AccessControl;

/**
 * Class PackagesController
 * @package arter\amos\utility\controllers
 */
class PackagesController extends BackendController
{
    public $layout = "main";

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'index',
                            'requirements'
                        ],
                        'roles' => ['ADMIN']
                    ],
                ],
            ],
        ];
    }

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
     * @param null $layout
     * @return bool
     */
    public function setUpLayout($layout = null)
    {
        if ($layout === false) {
            $this->layout = false;
            return true;
        }
        $module = \Yii::$app->getModule('layout');
        if (empty($module)) {
            $this->layout = '@vendor/arter/amos-core/views/layouts/' . (!empty($layout) ? $layout : $this->layout);
            return true;
        }
        $this->layout = (!empty($layout)) ? $layout : $this->layout;
        return true;
    }

    public function actionIndex()
    {
        $basepath = \Yii::$app->getBasePath() . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR;

        $composerLock = file_get_contents($basepath . 'composer.lock');
        $composerJson = file_get_contents($basepath . 'composer.json');

        return $this->render('index', [
            'composerLock' => $composerLock,
            'composerJson' => $composerJson
        ]);
    }

    public function actionRequirements()
    {
        require(__DIR__ . '/../../../../yiisoft/yii2/requirements/YiiRequirementChecker.php');

        $requirementsChecker = new \YiiRequirementChecker();
        return $requirementsChecker->checkYii()->render();
    }
}
