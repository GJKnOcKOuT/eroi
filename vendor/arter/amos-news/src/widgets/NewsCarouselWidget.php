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
 * @package    arter\amos\news\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\news\widgets;

use arter\amos\core\forms\AmosCarouselWidget;
use arter\amos\news\models\News;
use yii\db\ActiveQuery;

/**
 * Class NewsCarouselWidget
 * @package arter\amos\news\widgets
 */
class NewsCarouselWidget extends AmosCarouselWidget
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setItems($this->getNewsItems());

        parent::init();
    }

    /**
     * @return array
     */
    protected function getNewsItems()
    {
        $newsHighlights = [];
        $highlightsModule = \Yii::$app->getModule('highlights');

        if (!is_null($highlightsModule)) {
            /** @var \amos\highlights\Module $highlightsModule */
            $newsHighlightsIds = $highlightsModule->getHighlightedContents(News::className());
            /** @var ActiveQuery $query */
            $query = News::find()
                ->distinct()
                ->andWhere(['id' => $newsHighlightsIds])
                ->andWhere(['status' => News::NEWS_WORKFLOW_STATUS_VALIDATO])
                ->andWhere(['or',
                    ['data_rimozione' => null],
                    ['>=', 'data_rimozione', date('Y-m-d')]
                ]);
            
            $newsHighlights = $query->all();
        }

        return $newsHighlights;
    }
}