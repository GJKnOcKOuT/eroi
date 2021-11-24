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
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms;

use arter\amos\admin\AmosAdmin;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\tag\AmosTag;
use arter\amos\tag\models\Tag;
use yii\base\Widget;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\helpers\ArrayHelper;

/**
 * Class ListTagsWidget
 * @package arter\amos\core\forms
 */
class ListTagsWidget extends Widget
{
    public $layout = "@vendor/arter/amos-core/forms/views/widgets/widget_list_tags.php";
    protected $userProfile;
    protected $className;
    protected $userTagList;

    public $viewFilesCounter = false;
    public $pageSize = 10;
    public $withTitle = false;

    /**
     * @var AmosTag|null $moduleTag
     */
    protected $moduleTag = null;

    /**
     * @var array $rootIdsArray
     */
    public $rootIdsArray = [];

    /**
     * @var array $rootIdsArrayToExclude
     */
    public $rootIdsArrayToExclude = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->moduleTag = \Yii::$app->getModule('tag');

        if (empty($this->rootIdsArray) && !is_null($this->moduleTag)) {
            /** @var ActiveQuery $query */
            $query = Tag::find();
            $query->select(['root'])->distinct()->groupBy('root');
            if (is_array($this->rootIdsArrayToExclude) && !empty($this->rootIdsArrayToExclude)) {
                $query->andWhere(['not in', 'root', $this->rootIdsArrayToExclude]);
            }
            $this->rootIdsArray = $query->column();
        }
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $allTag = null;
        $widget = '';

        $userProfileClass = AmosAdmin::instance()->model('UserProfile');
        // $module = Yii::$app->getModule(AmosAdmin::getModuleName());
        // $userProfileClass = $module::getInstance()->model('UserProfile');

        $classes_enabled = ArrayHelper::merge($this->moduleTag->modelsEnabled, [$userProfileClass]);
        $showTags = isset($this->moduleTag) && in_array($this->className, $classes_enabled) && $this->moduleTag->behaviors;

        if ($showTags) {
            $query = $this->getTags();
            $dataProvider = new ActiveDataProvider([
                'query' => $query
            ]);

            $widget = $this->renderFile($this->getLayout(), [
                'dataProvider' => $dataProvider,
                'viewFilesCounter' => $this->viewFilesCounter,
                'filesQuantity' => $query->count(),
                'pageSize' => $this->pageSize
            ]);

            if ($this->withTitle) {
                $widget = Html::tag('h2', AmosIcons::show('tag', [], 'dash') . BaseAmosModule::t('amoscore', '#tags_title')) . '<div class="col-xs-12">' . $widget . '</div>';
            }
        }

        return $widget;
    }

    /**
     * @return $this
     * @throws \yii\base\InvalidConfigException
     */
    protected function getTags()
    {
        
        $userProfileClass = AmosAdmin::instance()->model('UserProfile');
        // $module = Yii::$app->getModule(AmosAdmin::getModuleName());
        // $userProfileClass = $module::getInstance()->model('UserProfile');

        if ($this->className == $userProfileClass) {
            $tagsMm = \arter\amos\cwh\models\CwhTagOwnerInterestMm::find()
                ->innerJoin('tag', 'tag.id = tag_id')
                ->andWhere([
                    'record_id' => $this->userProfile,
                ])
                ->orderBy([
                    'tag.nome' => SORT_DESC
                ])->all();
        } else {
            $tagsMm = \arter\amos\tag\models\EntitysTagsMm::find()
                ->joinWith('tag')
                ->andWhere([
                    'classname' => $this->className,
                    'record_id' => $this->userProfile,
                ])
                ->orderBy([
                    'tag.nome' => SORT_DESC
                ])->all();
        }

        $tagListId = [];
        foreach ($tagsMm as $elem) {
            $tagListId [] = $elem->tag_id;
        }

        $query = Tag::find()->andWhere(['id' => $tagListId]);
        if (is_array($this->rootIdsArray) && !empty($this->rootIdsArray)) {
            $query->andWhere(['root' => $this->rootIdsArray]);
        }

        return $query;
    }

    /**
     * @return string
     */
    public function getLayout()
    {
        return $this->layout;
    }

    /**
     * @return mixed
     */
    public function getUserProfile()
    {
        return $this->userProfile;
    }

    /**
     * @param mixed $userProfile
     */
    public function setUserProfile($userProfile)
    {
        $this->userProfile = $userProfile;
    }

    /**
     * @return mixed
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param mixed $className
     */
    public function setClassName($className)
    {
        $this->className = $className;
    }
}
