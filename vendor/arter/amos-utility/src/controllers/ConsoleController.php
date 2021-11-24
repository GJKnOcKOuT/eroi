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
use Yii;
use yii\filters\AccessControl;

/**
 * Class ConsoleController
 * @package arter\amos\utility\controllers
 */
class ConsoleController extends BackendController
{
    public $layout = 'main';
    private $rootDir = '';

    /**
     * Disable CSRF
     */
    public function init()
    {
        parent::init();
        $this->enableCsrfValidation = false;
        $this->setUpLayout();

        //The project root dir
        $this->rootDir = Yii::getAlias('@vendor/..');
    }

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
                            'migrate',
                            'run-cmd',
                        ],
                        'roles' => ['ADMIN']
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     *
     * @param string $cmd
     */
    public function actionRunCmd($cmd)
    {
        $output = '';
        Yii::$app->consoleRunner->run($cmd, $output);
        return $this->render('output', ['output' => $output]);
    }

    public function actionMigrate($force = false)
    {
        $migrate = new MigrationsController('migrate', $this->module);
        $migrations = $migrate->getMigrations();

        try {
            $result = $force ? (string) $migrate->applyMigrations() : null;
        } catch (\Exception $e) {
            $result = $e->getMessage();
        }

        return $this->render('migrate', [
            'migrations' => $migrations,
            'result' => $result,
            'force' => $force
        ]);
    }
}
