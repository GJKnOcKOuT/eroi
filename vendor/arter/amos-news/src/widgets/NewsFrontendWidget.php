<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

/**
 */

namespace arter\amos\news\widgets;

use arter\amos\news\models\News;
use yii\base\Widget;
use yii\data\ActiveDataProvider;

class NewsFrontendWidget extends Widget
{
    const TYPE_HIGHLIGHTS = 'highlights';
    const TYPE_FRONTEND   = 'frontend';
    const TYPE_ALL        = 'all';

    public $tags = [];
    public $andWhereInIds = [];
    public $category;
    public $type                    = NewsFrontendWidget::TYPE_ALL;
    public $statuses                = [];
    public $validated_at_least_once = false;
    public $queryOrderBy;
    public $view_path               = '@vendor/arter/amos-news/src/widgets/views/news_frontend_item';
    public $paginationPageSize = 20;

    /**
     *
     */
    public function init()
    {
        parent::init();
    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function run()
    {
        $query = News::find();

        if ($this->type == NewsFrontendWidget::TYPE_FRONTEND) {
            $query->andWhere(['primo_piano' => 1]);
        } else if ($this->type == NewsFrontendWidget::TYPE_HIGHLIGHTS) {
            $query->andWhere(['in_evidenza' => 1]);
        }

        if ($this->validated_at_least_once) {
            $query->innerJoin('amos_workflow_transitions_log', 'owner_primary_key = news.id')
                ->andWhere(['end_status' => News::NEWS_WORKFLOW_STATUS_VALIDATO]);
        } else {
            if (!empty($this->statuses)) {
                $query->andWhere(['status' => $this->statuses]);
            }
        }

        if (!empty($this->tags) && count($this->tags) > 0) {
            $newsClassname = News::className();
            $newsClassname = addslashes($newsClassname);
            $query->leftJoin('entitys_tags_mm', "entitys_tags_mm.record_id=news.id AND entitys_tags_mm.classname='$newsClassname'")
            ->andFilterWhere(['entitys_tags_mm.tag_id' => $this->tags]);
        }

        if(!empty($this->andWhereInIds)){
            $query->andFilterWhere(['news.id' => $this->andWhereInIds]);
        }

        if (!empty($this->category)) {
            $query->andWhere(['news_categorie_id' => $this->category]);
        }

        if (!empty($this->queryOrderBy)) {
            $query->orderBy(new \yii\db\Expression("{$this->queryOrderBy}"));
        }

        /** @var  $dataProvider */
        $dataProvider = new ActiveDataProvider([
            'query' => $query
        ]);
        $dataProvider->pagination->pageSize = $this->paginationPageSize;

        return $this->render('news_frontend_index', ['dataProvider' => $dataProvider, 'view_item' => $this->view_path]);
    }
}