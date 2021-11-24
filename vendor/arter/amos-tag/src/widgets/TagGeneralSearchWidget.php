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
 * @package    arter\amos\tag\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\tag\widgets;

use arter\amos\tag\models\EntitysTagsMm;
use arter\amos\tag\models\Tag;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\widgets\InputWidget;

/**
 * Class TagWidget
 *
 * @property \arter\amos\core\record\Record $model
 *
 * @package arter\amos\tag\widgets
 */
class TagGeneralSearchWidget extends InputWidget
{
    public $form;
    public $name = 'tagValues';
    public $trees = [];
    public $singleFixedTreeId;
    public $form_values;
    public $isSearch = false;
    public $hideHeader = false;

    /**
     * @var string $id the id of the widget container div
     */
    public $id = 'amos-tag';

    /**
     * @var string $containerClass the class of the widget container div
     */
    public $containerClass = 'tag-widget';

    /**
     * @throws \ReflectionException
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        if(!isset($this->form_values)){
            $post = Yii::$app->request->post($this->model->formName());
            if(!empty($post) && key_exists($this->name, $post)){
                $this->form_values = $post[$this->name];
            }
        }
        $this->trees = $this->fetchAllTrees();

    }


    /**
     * @return array|ActiveRecord[]
     * @throws \ReflectionException
     */
    private function fetchAllTrees()
    {
        /** @var ActiveQuery $query */
        $query = Tag::find()
            ->joinWith('tagModelsAuthItems')
            ->andWhere(['lvl' => 0])
            ->andWhere([
                'auth_item' => array_keys(\Yii::$app->authManager->getRolesByUser(\Yii::$app->getUser()->getId()))
            ]);

        if (!empty($this->singleFixedTreeId)){
            $query->andWhere(["tag.id" => $this->singleFixedTreeId ]);
        }

        $query->orderBy(['tag.nome' => SORT_DESC]);

        return $query->all();
    }



    /**
     * @inheritdoc
     */
    public function run()
    {

        $tagsSelected = ($this->form_values ? $this->getTagsSelectedFromFormValues() : []);
        return $this->render('tag_search_general', [
            'model' => $this->model,
            'form' => $this->form,
            'name' => $this->name,
            'trees' => $this->trees,
            'tags_selected' => $tagsSelected,
            'limit_trees' => $this->getLimitTrees(),
            'hideHeader' => $this->hideHeader,
            'id' => $this->id,
            'containerClass' => $this->containerClass
        ]);
    }


    /**
     * @return array
     */
    private function getTagsSelectedFromFormValues()
    {
        $ret = [];
        if (isset($this->form_values)) {
            foreach ($this->form_values as $treeId => $treeSelectedTags) {
                $selectedTagIds = explode(',', $treeSelectedTags);
                if ($treeSelectedTags && !array_key_exists("tree_" . $treeId, $ret)) {
                    $ret["tree_" . $treeId] = [];
                }
                foreach ($selectedTagIds as $tagId) {
                    if (!empty($tagId)) {
                        $tagObj = $this->getTagById($tagId);
                        if (!is_null($tagObj)) {
                            if($treeId == $tagObj->root) {
                                if (!array_key_exists("tree_" . $treeId, $ret)) {
                                    $ret["tree_" . $treeId] = [];
                                }
                                $element = [
                                    "id" => $tagObj->id,
                                    "label" => $tagObj->nome
                                ];
                                if(!in_array($element, $ret["tree_" . $treeId])){
                                    $ret["tree_" . $treeId][] = $element;
                                }
                            }
                        }
                    }
                }
            }
        }
        return $ret;
    }

    /**
     * @param int $tagId
     * @return Tag
     */
    private function getTagById($tagId)
    {
        return Tag::findOne($tagId);
    }

    /**
     * @return array
     */
    private function getLimitTrees()
    {
        $array_limit_trees = [];

        foreach ($this->trees as $tree) {
            //limite di default: nessun limite
            $limit_tree = false;

            if(!$this->isSearch) {
                //carica il nodo radice
                $root_node = $this->getTagById($tree['id']);

                //se è presente un limite impostato per questa radice allora lo usa
                if ($root_node->limit_selected_tag && is_numeric($root_node->limit_selected_tag)) {
                    $limit_tree = $root_node->limit_selected_tag;
                }
            }

            $array_limit_trees["tree_" . $tree['id']] = $limit_tree;
        }

        return $array_limit_trees;
    }

    /**
     * @return array the roles that the user logged have
     */
    private function getAllRoles()
    {
        if (Yii::$app->getModule('admin')->modelMap['UserProfile'] == get_class($this->model)) {
            $keysRoles = array_keys(\Yii::$app->getAuthManager()->getRolesByUser($this->model['user_id']));
        } else {
            $keysRoles = array_keys(\Yii::$app->getAuthManager()->getRolesByUser(\Yii::$app->getUser()->getId()));
        }

        // i want all roles that user has
        $allRoles = [];
        foreach ($keysRoles as $role) {
            $allRoles = array_unique(array_merge($allRoles,
                array_keys(\Yii::$app->getAuthManager()->getChildRoles($role))));
        }

        return $allRoles;
    }


    /**
     * @return ActiveRecord[] tutte le root
     */
    private function fetchRoles()
    {
        /**@var ActiveQuery $query * */
        $query = Tag::find()->joinWith('tagAuthItemsMms')->andWhere(['auth_item' => array_keys(\Yii::$app->authManager->getRolesByUser(\Yii::$app->getUser()->getId()))]);

        return $query->all();
    }
}
