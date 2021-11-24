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
 * @package    arter\amos\attachments\controllers 
 * @author     Elite Division S.r.l.
 */
 
namespace arter\amos\attachments\controllers;
use arter\amos\attachments\models\AttachGallery;
use arter\amos\attachments\models\AttachGalleryCategory;
use arter\amos\attachments\models\AttachGalleryImage;
use arter\amos\dashboard\controllers\TabDashboardControllerTrait;
use arter\amos\layout\Module;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class AttachGalleryController 
 * This is the class for controller "AttachGalleryController".
 * @package arter\amos\attachments\controllers 
 */
class AttachGalleryController extends \arter\amos\attachments\controllers\base\AttachGalleryController
{

    /**
     * @inheritdoc
     */
    public function behaviors() {
        $behaviors = ArrayHelper::merge(parent::behaviors(), [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => [
                            'load-modal',
                            'single-gallery'
                        ],
                        'roles' => ['@']
                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post', 'get']
                ]
            ]
        ]);
        return $behaviors;
    }

    /**
     * @param $galleryId
     * @param $attribute
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function actionLoadModal($galleryId, $attribute){
        $gallery = AttachGallery::findOne($galleryId);
        if($gallery) {
            $images = $gallery->attachGalleryImages;
            $categories = AttachGalleryCategory::find()->orderBy('default_order ASC')->all();
            return $this->renderAjax('@vendor/arter/amos-attachments/src/components/views/gallery-view', [
                'attribute' => $attribute,
                'images' => $images,
                'gallery' => $gallery,
                'categories' => $categories,
            ]);
        }
        return '';
    }

    /**
     * @return string|\yii\web\Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionSingleGallery(){

        $this->setUpLayout('form');
        $this->model = $this->findModel(1);
        $this->setCreateNewBtnLabelSingle();

        $this->setListViewsParams($setCurrentDashboard = true);
        $dataProviderImages = new ActiveDataProvider([
            'query' => $this->model->getAttachGalleryImages()
        ]);

        if ($this->model->load(Yii::$app->request->post()) && $this->model->validate()) {
            if ($this->model->save()) {
                Yii::$app->getSession()->addFlash('success', Yii::t('amoscore', 'Item updated'));
                return $this->redirect(['update', 'id' => $this->model->id]);
            } else {
                Yii::$app->getSession()->addFlash('danger', Yii::t('amoscore', 'Item not updated, check data'));
            }
        }

        return $this->render('update', [
            'model' => $this->model,
            'fid' => NULL,
            'dataField' => NULL,
            'dataEntity' => NULL,
            'dataProviderImages' => $dataProviderImages
        ]);
    }

    /**
     * Set a view param used in \arter\amos\core\forms\CreateNewButtonWidget
     */
    private function setCreateNewBtnLabelSingle()
    {
        Yii::$app->view->params['createNewBtnParams'] = [
            'createNewBtnLabel' => Module::t('amossitemanagement', 'New')
        ];
        Yii::$app->view->params['createNewBtnParams']['layout'] = '';

    }


}
