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
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;


/**
 * Class AttachGalleryImageController 
 * This is the class for controller "AttachGalleryImageController".
 * @package arter\amos\attachments\controllers 
 */
class AttachGalleryImageController extends \arter\amos\attachments\controllers\base\AttachGalleryImageController
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
                            'upload-from-gallery-ajax',
                            'delete-from-session-ajax',
                            'load-modal'
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
     * @param $id
     * @param $csrf
     * @return array
     */
    public function actionUploadFromGalleryAjax($id, $attribute, $csrf){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $image = AttachGalleryImage::findOne($id);
        if($image) {
            $data = ['id' => $id, 'attribute' => $attribute];
            \Yii::$app->session->set($csrf, $data);
            return ['success' => true];
        }
        return ['success' => false];
    }

    /**
     * @param $id
     * @param $csrf
     * @return array
     */
    public function actionDeleteFromSessionAjax($csrf){
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        \Yii::$app->session->remove($csrf);

        return ['success' => false];
    }

    /**
     * @param $id
     * @param $csrf
     * @return array
     */
    public function actionLoadModal($galleryId, $attribute){
        $gallery = AttachGallery::findOne($galleryId);
        if($gallery) {
            $images = $gallery->attachGalleryImages;
            $categories = AttachGalleryCategory::find()->all();
            return $this->renderAjax('@vendor/arter/amos-attachments/src/components/views/gallery-view', [
                'attribute' => $attribute,
                'images' => $images,
                'gallery' => $gallery,
                'categories' => $categories,
            ]);
        }

    }
}
