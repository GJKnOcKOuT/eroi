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
 * @package    arter\amos\slideshow\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\slideshow\controllers;

use arter\amos\slideshow\models\SlideshowRoute;
use arter\amos\slideshow\models\SlideshowUserflag;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;

/**
 * Class SlideshowController
 * @package arter\amos\slideshow\controllers
 *
 * This is the class for controller "SlideshowController".
 */
class SlideshowController extends \arter\amos\slideshow\controllers\base\SlideshowController
{
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
                            'cambia',
                            'route-by-role',
                        ],
                        'roles' => ['@']
                    ]
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'route-by-role' => ['post']
                ]
            ]
        ]);
        return $behaviors;
    }

    /**
     * @return bool
     */
    public function actionCambia()
    {
        if (\Yii::$app->request->isAjax) {
            if (!\Yii::$app->getUser()->isGuest) {
                $data = \Yii::$app->request->post();
                if (isset($data['set']) && $data['set'] == 'true') {
                    $routeId = $data['value'];
                    $userId = \Yii::$app->getUser()->getId();
                    $slideshowUserflag = SlideshowUserflag::findOne(['user_id' => $userId, 'slideshow_route_id' => $routeId]);
                    if (!$slideshowUserflag) {
                        $slideshowUserflag = new SlideshowUserflag();
                        $slideshowUserflag->slideshow_route_id = $routeId;
                        $slideshowUserflag->user_id = $userId;
                        $slideshowUserflag->save(FALSE);
                    }
                } else {
                    $routeId = $data['value'];
                    $userId = \Yii::$app->getUser()->getId();
                    $slideshowUserflag = SlideshowUserflag::deleteAll(['user_id' => $userId, 'slideshow_route_id' => $routeId]);
                }
            }
        }

        return TRUE;
    }

    public function actionRouteByRole()
    {
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $id = end($_POST['depdrop_parents']);
            $id_selected = end($_POST['depdrop_params']);
            $slideshow = new SlideshowRoute();
            $routes = $slideshow->getRotte(NULL, $id);
            $selected = null;

            if ($id != null && count($routes) > 0) {
                $selected = '';
                foreach ($routes as $i => $route) {

                    $out[] = ['id' => $i, 'name' => $route];

                    if ($id_selected) {
                        $selected = $id_selected;
                    } elseif ($i == 0) {
                        $selected = $i;
                    }
                }
                // Shows how you can preselect a value
                echo Json::encode(['output' => $out, 'selected' => $selected]);
                return;
            }
        }

        echo Json::encode(['output' => '', 'selected' => '']);
    }
}
