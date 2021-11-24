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

namespace arter\amos\mobile\bridge\modules\v1\actions\entitydata\parsers;

use arter\amos\news\models\search\NewsSearch;
use Yii;
use arter\amos\admin\models\UserProfile;
use arter\amos\community\models\Community;
use arter\amos\core\record\Record;
use arter\amos\mobile\bridge\modules\v1\models\AccessTokens;
use arter\amos\mobile\bridge\modules\v1\models\User;
use arter\amos\news\models\News;
use yii\base\Exception;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\helpers\Json;

class ItemsParser
{
    public static function getItems($namespace, $bodyParams)
    {
        /**
         * Class for this fetch, expected Record
         * @var $class Record
         */
        $class = new $namespace();

        //Paginated offset
        $offset = $bodyParams['offset'] * 20;

        //Check limit is set
        $limit = (int) $bodyParams['limit'] ?: 20;

        /**
         * @var $items Record[]
         */
        $items = $class::find()
            //->asArray()
            ->limit($limit > 20 ? 20 : $limit)
            ->orderBy(['id' => SORT_DESC])
            /*->select([

            ])*/
            ->offset($offset)
            ->all();
        // ->andWhere([]);

        //Resulting array of items
        $itemsArray = [];

        //The base class name
        $baseClassName = \yii\helpers\StringHelper::basename($namespace);

        //Read permission name
        $readPremission = strtoupper($baseClassName . '_READ');

        //Edit permission name
        $editPremission = strtoupper($baseClassName . '_UPDATE');

        foreach ($items as $item) {
            //Can user view element
            $canView = \Yii::$app->user->can($readPremission, ['model' => $model]);

            if ($canView) {
                //Define temp item
                $newItem = [];

                //Need id column
                $newItem['id'] = $item->id;

                //Get the list of description fields
                $newItem['representingColumn'] = $item->representingColumn();

                //Fill fields from item usable in app
                $newItem['fields'] = $item->toArray();

                //Remove id as is not needed
                unset($newItem['fields']['id']);

                //Can edit
                $newItem['canEdit'] = \Yii::$app->user->can($editPremission, ['model' => $model]);

                //Insert New Item
                $itemsArray[] = $newItem;
            }
        }

        return $itemsArray;
        /*

        //Instance search model
        $newsSearch = new NewsSearch();

        //Use search data provider
        $dataProvider = $newsSearch->searchOwnInterest([
            'offset' => $offset,
            'limit' => 20
        ]);

        //Fetch news and parse it
        $items = $dataProvider->getModels();

        //Resulting array of items
        $itemsArray = [];

        //The base class name
        $baseClassName = \yii\helpers\StringHelper::basename(\arter\amos\news\models\base\News::className());

        //Read permission name
        $readPremission = strtoupper($baseClassName . '_READ');

        //Edit permission name
        $editPremission = strtoupper($baseClassName . '_UPDATE');

        foreach ($items as $item) {
            //Can user view element
            $canView = \Yii::$app->user->can($readPremission, ['model' => $item]);

            if ($canView) {
                //Define temp item
                $newItem = [];

                //Need id column
                $newItem['id'] = $item->id;

                //Get the list of description fields
                $newItem['representingColumn'] = $item->representingColumn();

                //Creator profile
                $owner = UserProfile::findOne(['id' => $item->created_by]);

                //Image
                $image = $item->newsImage;

                //Fill fields from item usable in app
                $newItem['fields'] = [
                    'slug' => $item->slug,
                    'titolo' => $item->titolo,
                    'sottotitolo' => $item->sottotitolo,
                    'descrizione_breve' => strip_tags($item->descrizione_breve),
                    'descrizione' => strip_tags($item->descrizione),

                    'data_pubblicazione' => $item->data_pubblicazione,
                    'created_at' => $item->created_at,
                    'created_by' => $item->created_by,
                    'comments_enabled' => $item->comments_enabled,
                    'owner' => [
                        'nome' => $owner->nome,
                        'cognome' => $owner->cognome,
                        'presentazione_breve' => $owner->presentazione_breve,
                        'avatarUrl' => $owner->avatarUrl,
                    ],
                    'newsImageUrl' => $image ? \Yii::$app->getUrlManager()->createAbsoluteUrl($image->getWebUrl()) : null,
                ];

                //Remove id as is not needed
                unset($newItem['fields']['id']);

                //Can edit
                $newItem['canEdit'] = \Yii::$app->user->can($editPremission, ['model' => $item]);

                //Insert New Item
                $itemsArray[] = $newItem;
            }
        }

        return $itemsArray;*/
    }
}