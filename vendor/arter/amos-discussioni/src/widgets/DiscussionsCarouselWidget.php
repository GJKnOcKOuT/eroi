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
 * @package    arter\amos\discussioni\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\discussioni\widgets;

use arter\amos\core\forms\AmosCarouselWidget;
use arter\amos\discussioni\models\DiscussioniTopic;
use yii\db\ActiveQuery;

/**
 * Class DiscussionsCarouselWidget
 * @package arter\amos\discussioni\widgets
 */
class DiscussionsCarouselWidget extends AmosCarouselWidget {

    /**
     * @inheritdoc
     */
    public function init() {
        $this->setItems($this->getDiscussionsItems());

        parent::init();
    }

    /**
     * @return array
     */
    protected function getDiscussionsItems() {
        $discussionsHighlights = [];
        $highlightsModule = \Yii::$app->getModule('highlights');

        if (!is_null($highlightsModule)) {
            /** @var \amos\highlights\Module $highlightsModule */
            $discussionsHighlightsIds = $highlightsModule->getHighlightedContents(DiscussioniTopic::className());
            /** @var ActiveQuery $query */
            $query = DiscussioniTopic::find()
                ->distinct()
                ->andWhere(['id' => $discussionsHighlightsIds])
                ->andWhere(['status' => DiscussioniTopic::DISCUSSIONI_WORKFLOW_STATUS_ATTIVA]);

            $discussionsHighlights = $query->all();
        }

        return $discussionsHighlights;
    }

}
