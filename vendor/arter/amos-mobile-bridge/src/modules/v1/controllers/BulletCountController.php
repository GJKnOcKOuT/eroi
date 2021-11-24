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

use arter\amos\chat\models\Message;
use arter\amos\discussioni\models\DiscussioniTopic;
use arter\amos\discussioni\models\search\DiscussioniTopicSearch;
use arter\amos\news\models\News;
use arter\amos\news\models\search\NewsSearch;
use Yii;
use yii\db\Query;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\httpclient\Exception;
use yii\rest\Controller;
use yii\swiftmailer\Logger;

class BulletCountController extends Controller
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
                        'bullet-count' => ['post'],
                    ],
                ],
        ]);
    }

    /**
     * 
     * @return integer
     */
    public function actionBulletCount()
    {
        $count = 0;
        try {
            //Request params
            $bodyParams = Yii::$app->getRequest()->getBodyParams();

            //Refference namespace
            $classname = $bodyParams['namespace'];
            $count = $this->makeBulletCounter(
                Yii::$app->getUser()->getId(),
                $classname,
                $this->evaluateSearchModel($classname)
            );
        } catch (Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $count;
    }

    /**
     * 
     * @param integer $userId
     * @param string $className
     * @param Query $externalQuery
     * @return int
     */
    private function makeBulletCounter($userId = null, $className = null, $externalQuery = null)
    {
        if (isset(\Yii::$app->params['disableBulletCounters']) && (\Yii::$app->params['disableBulletCounters'] === true)) {
            return 0;
        }

        if (($userId == null) || ($className == null)) {
            return 0;
        }

        $count = 0;
        $notifier = Yii::$app->getModule('notify');
        if ($notifier) {
            $count = $notifier->countNotRead(
                $userId,
                $className,
                $externalQuery
            );
        }

        return $count;
    }

    /**
     * 
     * @param string $classname
     */
    private function evaluateSearchModel($classname)
    {
        $query = null;

        switch ($classname) {
            case News::className():
                $modelSearch = new NewsSearch();
                $query = $modelSearch->buildQuery([], 'own-interest');
                break;
            case DiscussioniTopic::className():
                $modelSearch = new DiscussioniTopicSearch();
                $query = $modelSearch->buildQuery([], 'own-interest');
                break;
            case Message::className():

                $query = Message::find()
                    ->andWhere([
                    'is_new' => true,
                    'receiver_id' => Yii::$app->getUser()->getId(),
                    'is_deleted_by_receiver' => false
                ]);
                break;
        }

        return $query;
    }
}
