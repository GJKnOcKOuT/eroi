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
 * @package    arter\amos\news\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\news\models;

use arter\amos\attachments\behaviors\FileBehavior;
use arter\amos\attachments\models\File;
use arter\amos\news\AmosNews;
use yii\helpers\ArrayHelper;

/**
 * Class NewsCategorie
 * This is the model class for table "news_categorie".
 *
 * @method \yii\db\ActiveQuery hasOneFile($attribute = 'file', $sort = 'id')
 *
 * @package arter\amos\news\models
 */
class NewsCategorie extends \arter\amos\news\models\base\NewsCategorie
{
    /**
     * @var File $categoryIcon
     */
    public $categoryIcon;
    public $newsCategoryCommunities;
    public $newsCategoryRoles;
    public $visibleToCommunityRole;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['categoryIcon'], 'file', 'maxFiles' => 1, 'extensions' => 'jpeg, jpg, png, gif'],
            [['newsCategoryCommunities','newsCategoryRoles','visibleToCommunityRole', 'publish_only_on_community'], 'safe']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'categoryIcon' => AmosNews::t('amosnews', 'Icona')
        ]);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'fileBehavior' => [
                'class' => FileBehavior::className()
            ]
        ]);
    }

    /**
     * Ritorna l'url dell'avatar.
     *
     * @param string $size Dimensione. Default = original.
     * @return string Ritorna l'url.
     */
    public function getAvatarUrl($size = 'original')
    {
        return $this->getCategoryIconUrl($size);
    }

    /**
     * Getter for $this->categoryIcon;
     * @return File
     */
    public function getCategoryIcon()
    {
        if (empty($this->categoryIcon)) {
            $this->categoryIcon = $this->hasOneFile('categoryIcon')->one();
        }
        return $this->categoryIcon;
    }

    /**
     * @param $categoryIcon
     */
    public function setCategoryIcon($categoryIcon)
    {
        $this->categoryIcon = $categoryIcon;
    }

    /**
     * @return string
     */
    public function getCategoryIconUrl($size = 'original', $protected = true, $url = '/img/img_default.jpg')
    {
        $categoryIcon = $this->getCategoryIcon();
        if (!is_null($categoryIcon)) {
            if ($protected) {
                $url = $categoryIcon->getUrl($size);
            } else {
                $url = $categoryIcon->getWebUrl($size);
            }
        }
        return $url;
    }

    /**
     *
     */
    public function saveNewsCategorieCommunityMm(){
        NewsCategoryCommunityMm::deleteAll(['news_category_id' => $this->id]);
        foreach ((Array) $this->newsCategoryCommunities as $community_id){
            $newsCommunityMm = new NewsCategoryCommunityMm();
            $newsCommunityMm->news_category_id = $this->id;
            $newsCommunityMm->community_id = $community_id;

            $newsCommunityMm->visible_to_cm = 0;
            if(array_search('COMMUNITY_MANAGER', $this->visibleToCommunityRole) !== false){
                $newsCommunityMm->visible_to_cm = 1;
            }
            $newsCommunityMm->visible_to_participant = 0;
            if(array_search('PARTICIPANT', $this->visibleToCommunityRole) !== false){
                $newsCommunityMm->visible_to_participant = 1;

            }
            $newsCommunityMm->save();
        }
    }

    /**
     *  load newsCategoryCommunities for Select2
     */
    public function loadNewsCategoryCommunities(){
        $community_ids = [];
        foreach ((Array) $this->newsCategoryCommunityMms as $categoryCommunityMms){
            $community_ids []= $categoryCommunityMms->community_id;

            if($categoryCommunityMms->visible_to_cm){
                $this->visibleToCommunityRole []= 'COMMUNITY_MANAGER';
            }
            if($categoryCommunityMms->visible_to_participant){
                $this->visibleToCommunityRole []= 'PARTICIPANT';
            }
        };
        $this->newsCategoryCommunities = $community_ids;

    }


    /**
     *
     */
    public function saveNewsCategorieRolesMm(){
        NewsCategoryRolesMm::deleteAll(['news_category_id' => $this->id]);
        foreach ((Array) $this->newsCategoryRoles as $role){
            $newsRoleMm = new NewsCategoryRolesMm();
            $newsRoleMm->news_category_id = $this->id;
            $newsRoleMm->role = $role;
            $newsRoleMm->save();
        }
    }
    /**
     *  load newsCategoryCommunities for Select2
     */
    public function loadNewsCategoryRoles(){
        $roles = [];
        foreach ((Array) $this->newsCategoryRolesMms as $categoryRolesMms){
            $roles [$categoryRolesMms->role]= $categoryRolesMms->role;
        };
        $this->newsCategoryRoles = $roles;
    }


}
