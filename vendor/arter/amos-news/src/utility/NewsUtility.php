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
 * @package    arter\amos\news\utility
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\news\utility;


use arter\amos\news\models\NewsCategorie;
use arter\amos\news\models\NewsCategoryRolesMm;
use yii\base\BaseObject;
use yii\db\ActiveQuery;

class NewsUtility extends BaseObject
{

    /**
     * @return ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public static function getNewsCategories()
    {
        /** @var ActiveQuery $query */
        $query = NewsCategorie::find();
        if(\Yii::$app->getModule('news')->filterCategoriesByRole){
            //check enabled role for category active - user can publish under a category if there's at least one match betwwn category and user roles
            $query->joinWith('newsCategoryRolesMms')->innerJoin('auth_assignment', 'item_name='. NewsCategoryRolesMm::tableName().'.role and user_id ='. \Yii::$app->user->id);
        }
          if(\Yii::$app->getModule('news')->enableCategoriesForCommunity){
            $moduleCwh = \Yii::$app->getModule('cwh');
            $moduleCommunity = \Yii::$app->getModule('community');

              if($moduleCwh && $moduleCommunity) {
                $scope = $moduleCwh->getCwhScope();
                //INSIDE A COMMUNITY
                if (!empty($scope) && isset($scope['community'])) {
                    $isCommunityManager = NewsUtility::isCommunityManager($scope['community']);
                 //SHOWALLCATEGORIES = TRUE
                    if(\Yii::$app->getModule('news')->showAllCategoriesForCommunity) {
                        $query->joinWith('newsCategoryCommunityMms')->andWhere([
                            'OR',
                            ['community_id' => null],
                            ['community_id' => $scope['community']]
                        ]);
                        // filter for  particiapants
                        if(!$isCommunityManager){
                            $query->andWhere(
                                ['OR',
                                ['community_id' => null],
                                ['visible_to_participant' => true]
                            ]);
                        }
                 //SHOWALLCATEGORIES = FALSE - show only categories that belongs to the community
                    } else {
                        $query2 = clone $query;
                        $count = $query2->joinWith('newsCategoryCommunityMms')
                            ->andWhere(['community_id' => $scope['community']])->count();

                        // if you have at least a category for this community show only them
                        if($count > 0) {
                            $query->joinWith('newsCategoryCommunityMms')
                                ->andWhere(['community_id' => $scope['community']]);
                            // filter for  participants
                            if(!$isCommunityManager){
                                $query->andWhere(['visible_to_participant' => true]);
                            }
                        } else {
                            // If you don't have categories for this specific community, show all the categories the the aren't assigned to some community
                            $query->joinWith('newsCategoryCommunityMms')
                                ->andWhere(['IS', 'community_id', NULL]);
                        }
                    }
                } else {
                    // IF YOU ARE ON DASHBOARD
                    $query->joinWith('newsCategoryCommunityMms')->andWhere(['IS', 'community_id', null]);
                }
            }
            //check enabled role for category active - user can publish under a category if there's at least one match betwwn category and user roles
        }
        return $query;
    }



    /**
     * @param $community_id
     * @return bool
     * @throws \yii\base\InvalidConfigException
     */
    public static function isCommunityManager($community_id){
        $count = \arter\amos\community\models\CommunityUserMm::find()
            ->andWhere(['community_id' => $community_id])
            ->andWhere(['user_id' => \Yii::$app->user->id])
            ->andWhere(['role' => \arter\amos\community\models\Community::ROLE_COMMUNITY_MANAGER])->count();
        return ($count > 0);

    }
}