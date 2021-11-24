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
 * @package     arter\amos\tag\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\tag\widgets;

use arter\amos\core\record\Record;
use arter\amos\tag\AmosTag;
use arter\amos\tag\models\Tag;
use arter\amos\tag\models\TagModelsAuthItemsMm;
use yii\base\Widget;

/**
 * Class ShowTagsWidget
 * @package arter\amos\tag\widgets
 */
class ShowTagsWidget extends Widget
{

    /**
     * @var Record $model
     */
    public $model;

    /**
     * @var integer $rootId
     */
    public $rootId;

    /**
     * @var array $rootIdsArray
     */
    public $rootIdsArray = [];


    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if($this->rootId){
            $this->rootIdsArray[] = $this->rootId;
        }
        if(empty($this->rootIdsArray)){
            $this->rootIdsArray = TagModelsAuthItemsMm::find()->andWhere(['classname' => get_class($this->model)])->groupBy('tag_id')->addSelect('tag_id')->column();
        }
    }


    /**
     * @inheritdoc
     */
    public function run()
    {

        if(!count($this->rootIdsArray)){
            return AmosTag::t('amostag', '#no_tree_enabled');
        }
        if(!empty( $this->model->getTagValues())) {
            $tagValues = explode(',', $this->model->getTagValues());
        }
        foreach ($this->rootIdsArray as $rootId) {
            $root = Tag::findOne($rootId);
            if(isset($tagValues)) {
                $tagsQuery = Tag::find()
                    ->andWhere(['root' => $rootId, 'id' => $tagValues])
                    ->andWhere(['<>', 'tag.id', 'tag.root'])
                    ->orderBy('lft,rgt');
                $tags = $tagsQuery->all();
            } else {
                $tags = [];
            }
            echo $this->render('show-tags-widget', ['root' => $root, 'tags' => $tags]);
        }
        return null;

    }


}
