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
 * @package    arter\amos\documenti\widgetRs\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\widgets\graphics;

use arter\amos\core\widget\WidgetGraphic;
use arter\amos\documenti\AmosDocumenti;
use arter\amos\documenti\models\search\DocumentiSearch;
use arter\amos\notificationmanager\base\NotifyWidgetDoNothing;

class WidgetGraphicsDocumentsExplorer extends WidgetGraphic
{
    /**
     * @inheritdocF
     */
    public function init()
    {
        parent::init();

        $this->setCode('DOCUMENTS_EXPLORER_GRAPHIC');
        $this->setLabel(AmosDocumenti::tHtml('amosdocumenti', 'Documenti'));
        $this->setDescription(AmosDocumenti::t('amosdocumenti', 'Naviga tra i documenti'));
    }

    public function getHtml()
    {
        return $this->render('documents-explorer/documents_explorer');
    }
}