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
 * @package    arter\amos\documenti\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\widgets;

use arter\amos\core\forms\AmosOwlCarouselWidget;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\Documenti;
use yii\db\ActiveQuery;

/**
 * Class DocumentsOwlCarouselWidget
 * @package arter\amos\documenti\widgets
 */
class DocumentsOwlCarouselWidget extends AmosOwlCarouselWidget
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->setItems($this->getDocumentsItems());

        parent::init();
    }

    /**
     * @return array
     */
    protected function getDocumentsItems()
    {
        $documentsHighlights = [];
        $highlightsModule = \Yii::$app->getModule('highlights');

        /** @var AmosDocumenti $documentsModule */
        $documentsModule = AmosDocumenti::instance();

        if (!is_null($highlightsModule)) {
            /** @var \amos\highlights\Module $highlightsModule */
            $documentsHighlightsIds = $highlightsModule->getHighlightedContents($documentsModule->model('Documenti'));
            /** @var Documenti $documentiModel */
            $documentiModel = $documentsModule->createModel('Documenti');
            /** @var ActiveQuery $query */
            $query = $documentiModel::find();
            $query->distinct();
            $query->andWhere(['id' => $documentsHighlightsIds]);
            $query->andWhere(['status' => Documenti::DOCUMENTI_WORKFLOW_STATUS_VALIDATO]);
            $query->andWhere(['or',
                ['data_rimozione' => null],
                ['>=', 'data_rimozione', date('Y-m-d')]
            ]);
            $documentsHighlights = $query->all();
        }

        return $documentsHighlights;
    }
}
