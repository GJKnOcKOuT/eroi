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
 * @package    arter\amos\documenti\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\controllers;

use arter\amos\core\controllers\CrudController;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\assets\ModuleDocumentiAsset;
use arter\amos\documenti\models\Documenti;
use arter\amos\documenti\models\search\DocumentiSearch;
use arter\amos\documenti\widgets\graphics\WidgetGraphicsHierarchicalDocuments;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/**
 * Class HierarchicalDocumentsController
 *
 * @property \arter\amos\documenti\models\Documenti $model
 *
 * @package arter\amos\documenti\controllers
 */
class HierarchicalDocumentsController extends CrudController
{
    /**
     * @var string $layout
     */
    public $layout = 'list';
    
    /**
     * @var AmosDocumenti $documentsModule
     */
    public $documentsModule = null;

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->documentsModule = \Yii::$app->getModule(AmosDocumenti::getModuleName());
        $this->setModelObj($this->documentsModule->createModel('Documenti'));
        $this->setModelSearch($this->documentsModule->createModel('DocumentiSearch'));

        ModuleDocumentiAsset::register(Yii::$app->view);

        $this->setAvailableViews([
            'expl' => [
                'name' => 'expl',
                'label' => AmosIcons::show('grid') . Html::tag('p', AmosDocumenti::tHtml('amosdocumenti', 'Icone')),
                'url' => '?currentView=expl'
            ],
            'icon' => [
                'name' => 'icon',
                'label' => AmosIcons::show('grid') . Html::tag('p', AmosDocumenti::tHtml('amosdocumenti', 'Icon')),
                'url' => '?currentView=icon'
            ],
            'grid' => [
                'name' => 'grid',
                'label' => AmosIcons::show('view-list-alt') . Html::tag('p', AmosDocumenti::tHtml('amosdocumenti', 'Table')),
                'url' => '?currentView=grid'
            ],
        ]);

        parent::init();
        $this->layout = false;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'render-hierarchical-documents-widget',
                        ],
                        'roles' => [
                            'LETTORE_DOCUMENTI',
                            'AMMINISTRATORE_DOCUMENTI',
                            'CREATORE_DOCUMENTI',
                            'FACILITATORE_DOCUMENTI',
                            'VALIDATORE_DOCUMENTI'
                        ]
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get'],
                ]
            ]
        ]);
        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function actionRenderHierarchicalDocumentsWidget()
    {
        Url::remember();
        $this->layout = false;
        return WidgetGraphicsHierarchicalDocuments::widget();
    }
}
