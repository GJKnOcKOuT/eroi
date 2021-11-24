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

use arter\amos\core\record\Record;
use arter\amos\mobile\bridge\modules\v1\actions\entitydata\ActionEditItem;
use arter\amos\mobile\bridge\modules\v1\actions\entitydata\ActionListItems;
use arter\amos\mobile\bridge\modules\v1\actions\entitydata\ActionViewItem;
use arter\amos\mobile\bridge\modules\v1\models\AccessTokens;
use arter\amos\mobile\bridge\modules\v1\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\helpers\ArrayHelper;
use yii\rest\Controller;

class EntityDataController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        $behaviours = parent::behaviors();
        unset($behaviours['authenticator']);

        return ArrayHelper::merge($behaviours,[
            'authenticator' => [
                'class' => CompositeAuth::className(),
                'authMethods' => [
                    'bearerAuth' => [
                        'class' => HttpBearerAuth::className(),
                    ]
                ],

            ],
        ]);
    }

    /**
     * @inheritdoc
     */
    public function verbs()
    {
        return [];
    }

    public function actions()
    {
        return [
            'list-items' => [
                'class' => ActionListItems::className(),
                'modelClass' => Record::className(),
            ],
            'edit-item' => [
                'class' => ActionEditItem::className(),
                'modelClass' => Record::className(),
            ],
            'view-item' => [
                'class' => ActionViewItem::className(),
                'modelClass' => Record::className(),
            ],
        ];
    }
}