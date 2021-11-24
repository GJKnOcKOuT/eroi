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

use arter\amos\admin\models\UserProfile;
use arter\amos\core\models\ContentShared;
use arter\amos\discussioni\models\DiscussioniTopic;
use arter\amos\discussioni\models\search\DiscussioniTopicSearch;
use Yii;
use yii\helpers\StringHelper;

class DiscussioniParser extends BaseParser
{
    /**
     * Get all items
     * @param $namespace
     * @param $bodyParams
     * @return array
     */
    public static function getItems($namespace, $bodyParams)
    {
        //Paginated offset
        $offset = $bodyParams['offset'] * 20;

        //Check limit is set
        $limit = (int)$bodyParams['limit'] ?: 20;

        //Instance search model
        $discussioniTopicSearch = new DiscussioniTopicSearch();

        //Use search data provider
        $dataProvider = $discussioniTopicSearch->searchOwnInterest([
            'offset' => $offset,
            'limit' => $limit > 20 ? 20 : $limit
        ]);

        //Fetch news and parse it
        $items = $dataProvider->getModels();

        //Resulting array of items
        $itemsArray = [];

        foreach ($items as $item) {
            $newItem = self::parseItem($item);

            if (!empty($newItem)) {
                //Insert New Item
                $itemsArray[] = $newItem;
            }
        }

        return $itemsArray;
    }

    /**
     * Get single discussion
     * @param $bodyParams
     * @return array
     */
    public static function getItem($bodyParams)
    {
        //Id of the record
        $identifier = $bodyParams['id'];

        //Fetch discussion and parse it
        $item = DiscussioniTopic::findOne($identifier);

        //Resulting array of items
        $itemsArray = [];

        return [self::parseItem($item)];
    }

    /**
     * Parse item and optain api designed array
     * @param $item
     * @return array
     */
    public static function parseItem($item)
    {
        //The base class name
        $baseClassName = StringHelper::basename(DiscussioniTopic::className());

        //Read permission name
        $readPremission = strtoupper($baseClassName . '_READ');

        //Edit permission name
        $editPremission = strtoupper($baseClassName . '_UPDATE');

        //Can user view element
        $canView = Yii::$app->user->can($readPremission, ['model' => $item]);

        if ($canView) {
            //Define temp item
            $newItem = [];

            //Need id column
            $newItem['id'] = $item['id'];

            //Get the list of description fields
            $newItem['representingColumn'] = $item->representingColumn();

            //Creator profile
            $owner = UserProfile::findOne(['id' => $item->created_by]);

            //Image
            $image = $item->discussionsTopicImage;

            //Fill fields from item usable in app
            $newItem['fields'] = [
                'slug' => $item->slug,
                'titolo' => $item->titolo,
                'testo' => html_entity_decode(strip_tags($item->testo)),
                'created_at' => $item->created_at,
                'created_by' => $item->created_by,
                'comments_enabled' => true,
                'owner' => [
                    'nome' => $owner->nome,
                    'cognome' => $owner->cognome,
                    'presentazione_breve' => $owner->presentazione_breve,
                    'avatarUrl' => $owner->avatarWebUrl,
                ],
                'newsImageUrl' => $image ? Yii::$app->getUrlManager()->createAbsoluteUrl($image->getWebUrl()) : null,
            ];
            $url = '';
            if (self::isContentShared($item)) {
                $view_url = $item->getViewUrl();
                $url = substr($view_url, 0, strrpos($view_url, "/")) . '/public' . "?id=" . $item->id;
            }
            $newItem['shareUrl'] = $url;
            $newItem['likeMe'] = self::isLikeMe($item);
            $newItem['countLikeMe'] = self::getCountLike($item);
            //Remove id as is not needed
            unset($newItem['fields']['id']);

            //Can edit
            $newItem['canEdit'] = Yii::$app->user->can($editPremission, ['model' => $item]);

            return $newItem;
        }

        return [];
    }
    
    /**
     * 
     * @param type $model
     * @return boolean
     */
    private static function isContentShared($model) {
        $obj = $model;
        if ($obj) {
            $classname = get_class($obj);
            $contentShared = ContentShared::find()
                            ->innerJoinWith('modelsClassname')
                            ->andWhere(['classname' => $classname, 'content_id' => $obj->id])->one();

            if ($contentShared) {
                return true;
            }
        }

        return false;
    }
}