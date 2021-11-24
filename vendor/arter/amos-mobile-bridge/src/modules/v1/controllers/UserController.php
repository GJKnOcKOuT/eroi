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
 * @package    arter\amos\mobile\bridge
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\mobile\bridge\modules\v1\controllers;


use yii\filters\auth\CompositeAuth;
use yii\filters\ContentNegotiator;
use yii\filters\Cors;
use yii\filters\RateLimiter;
use yii\filters\VerbFilter;
use yii\rest\Controller;
use yii\web\Response;

class UserController extends Controller
{

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'contentNegotiator' => [
                'class' => ContentNegotiator::className(),
                'formats' => [
                    'application/json' => Response::FORMAT_JSON,
                    'application/xml' => Response::FORMAT_XML,
                ],
            ],
            'verbFilter' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'update' => ['post'],
                    'image' => ['post'],
                    'follow' => ['post'],
                    'unfollow' => ['post'],
                ],
            ],
            'authenticator' => [
                'class' => CompositeAuth::className(),
            ],
            /*
            'rateLimiter' => [
                'class' => RateLimiter::className(),
            ],
            */
        ];
    }

    public function actionFollow()
    {
        return true;
    }

    public function actionUnfollow()
    {
        return true;
    }

    public function actionUpdate()
    {
        return true;
    }

    public function actionImage()
    {
        return true;

    }

}