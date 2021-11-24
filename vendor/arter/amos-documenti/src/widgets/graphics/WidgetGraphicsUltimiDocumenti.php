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
 * @package    arter\amos\documenti\widgets\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\widgets\graphics;

use arter\amos\core\widget\WidgetGraphic;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\Documenti;
use arter\amos\documenti\models\search\DocumentiSearch;
use arter\amos\notificationmanager\base\NotifyWidgetDoNothing;
use arter\amos\core\widget\WidgetAbstract;

/**
 * Class WidgetGraphicsUltimiDocumenti
 * @package arter\amos\documenti\widgets\graphics
 */
class WidgetGraphicsUltimiDocumenti extends WidgetGraphic
{
    /**
     * @var array $filterDocumentCategoryId
     */
    public $filterDocumentCategoryId = [];

    /**
     * @var string $widgetTitle
     */
    public $widgetTitle = '';

    /**
     * @var string|array $linkReadAll
     */
    public $linkReadAll = '';

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->widgetTitle = AmosDocumenti::tHtml('amosdocumenti', 'Documenti');
        $this->linkReadAll = ['/documenti'];

        parent::init();

        $this->setCode('ULTIME_DOCUMENTI_GRAPHIC');
        $this->setLabel(AmosDocumenti::tHtml('amosdocumenti', 'Ultimi documenti'));
        $this->setDescription(AmosDocumenti::t('amosdocumenti', 'Elenca gli ultimi documenti'));
    }

    /**
     * @inheritdoc
     */
    public function getHtml()
    {
        $listaDocumenti = $this->getDataProvider();

        $moduleL = \Yii::$app->getModule('layout');
        $viewPath = '@vendor/arter/amos-documenti/src/widgets/graphics/views/';
        $viewToRender = $viewPath . 'ultimi_documenti';

        if (empty($moduleL)) {
            $viewToRender .= '_old';
        }

        return $this->render($viewToRender, [
            'listaDocumenti' => $listaDocumenti,
            'widget' => $this,
            'toRefreshSectionId' => 'widgetGraphicLatestDocumenti'
        ]);
    }

    /**
     * Returns the widget data provider.
     * @return \yii\data\ActiveDataProvider
     */
    protected function getDataProvider()
    {
        /** @var DocumentiSearch $search */
        $search = AmosDocumenti::instance()->createModel('DocumentiSearch');
        $search->setNotifier(new NotifyWidgetDoNothing());
        $listaDocumenti = $search->lastDocuments($_GET, 3);
        if (!empty($this->filterDocumentCategoryId)) {
            $listaDocumenti->query->andWhere([Documenti::tableName() . '.documenti_categorie_id' => $this->filterDocumentCategoryId]);
        }
        return $listaDocumenti;
    }
}
