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

namespace arter\amos\mobile\bridge\modules\v1\actions\entitydata;

use arter\amos\admin\models\UserProfile;
use arter\amos\community\models\Community;
use arter\amos\core\record\Record;
use arter\amos\discussioni\models\DiscussioniTopic;
use arter\amos\mobile\bridge\modules\v1\actions\entitydata\parsers\DiscussioniParser;
use arter\amos\mobile\bridge\modules\v1\actions\entitydata\parsers\ItemsParser;
use arter\amos\mobile\bridge\modules\v1\actions\entitydata\parsers\NewsParser;
use arter\amos\mobile\bridge\modules\v1\models\AccessTokens;
use arter\amos\mobile\bridge\modules\v1\models\User;
use arter\amos\news\models\News;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\helpers\Json;
use yii\rest\Action;

class ActionListItems extends Action
{

    public function run()
    {
        //Request params
        $bodyParams = \Yii::$app->getRequest()->getBodyParams();

        //Refference namespace
        $namespace = $bodyParams['namespace'];

        //Default definition items array
        $itemsArray = [];

        switch ($namespace) {
            case News::className():
                {
                    $itemsArray = NewsParser::getItems($namespace, $bodyParams);
                }
                break;
            case DiscussioniTopic::className():
                {
                    $itemsArray = DiscussioniParser::getItems($namespace, $bodyParams);
                }
                break;
            default:
                {
                    $itemsArray = ItemsParser::getItems($namespace, $bodyParams);
                }
        }

        return $itemsArray;
    }
}