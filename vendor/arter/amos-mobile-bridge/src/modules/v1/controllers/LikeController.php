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

namespace arter\amos\mobile\bridge\modules\v1\controllers;

use arter\amos\core\models\ContentLikes;
use arter\amos\core\models\ModelsClassname;
use Yii;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\httpclient\Exception;
use yii\rest\Controller;
use yii\swiftmailer\Logger;

class LikeController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviours = parent::behaviors();
        unset($behaviours['authenticator']);

        return ArrayHelper::merge($behaviours, [
                'authenticator' => [
                    'class' => CompositeAuth::className(),
                    'authMethods' => [
                        'bearerAuth' => [
                            'class' => HttpBearerAuth::className(),
                        ]
                    ],
                ],
                'verbFilter' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'like' => ['post'],
                        'like-me' => ['post'],
                    ],
                ],
        ]);
    }

    /**
     * 
     * @param type $uid
     * @param type $cid
     * @param type $mid
     * @return type
     */
    private function getCounter($model_id = null, $model_class_id = null)
    {
        return ContentLikes::getLikesToCounter(null, $model_id, $model_class_id);
    }

    /**
     * 
     * @return type
     */
    public function actionLike()
    {
        $out = [];

        try {
            //Request params
            $bodyParams = Yii::$app->getRequest()->getBodyParams();

            //Refference namespace
            $classname = $bodyParams['namespace'];
            $cid = $bodyParams['cid'];

            if ($classname) {
                $uid = \Yii::$app->getUser()->id;
                $model_class_obj = ModelsClassname::find(['classname' => $classname])->one();
                if (!is_null($model_class_obj)) {
                    $rs = ContentLikes::find()
                        ->andWhere(
                            [
                                'content_id' => $cid,
                                'models_classname_id' => $model_class_obj->id,
                                'user_id' => $uid
                            ]
                        )
                        ->one();

                    if (empty($rs)) {
                        $rs = new ContentLikes();
                        $rs->user_id = $uid;
                        $rs->content_id = $cid;
                        $rs->models_classname_id = $model_class_obj->id;
                        $rs->user_ip = \Yii::$app->request->getUserIP();
                    }
                    $rs->likes = -1 * ($rs->likes - 1);
                    $rs->save();
                    $out = [
                        'tot' => $this->getCounter($cid, $model_class_obj->id),
                        'class' => ($rs->likes == 1) ? 'likeme' : 'notlikeme'
                    ];
                }
            }
        } catch (Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $out;
    }

    /**
     * 
     * @return type
     */
    public function actionLikeMe()
    {
        $out = [];

        try {
            //Request params
            $bodyParams = Yii::$app->getRequest()->getBodyParams();

            //Refference namespace
            $classname = $bodyParams['namespace'];
            $cid = $bodyParams['cid'];

            if ($classname) {
                $uid = \Yii::$app->getUser()->id;
                $model_class_obj = ModelsClassname::find(['classname' => $classname])->one();
                if (!is_null($model_class_obj)) {
                    $out = [
                        'tot' => $this->getCounter($cid, $model_class_obj->id),
                        'class' => (ContentLikes::getLikeMe($uid, $cid, $model_class_obj->id) == 1) ? 'likeme' : 'notlikeme'
                    ];
                }
            }
        } catch (Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $out;
    }
}
