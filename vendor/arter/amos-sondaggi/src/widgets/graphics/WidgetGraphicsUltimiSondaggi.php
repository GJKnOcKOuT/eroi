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
 * @package    arter\amos\news\widgets\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\sondaggi\widgets\graphics;

use arter\amos\core\widget\WidgetGraphic;
use arter\amos\sondaggi\AmosSondaggi;
use arter\amos\sondaggi\models\search\SondaggiSearch;
use arter\amos\notificationmanager\base\NotifyWidgetDoNothing;
use arter\amos\core\widget\WidgetAbstract;

class WidgetGraphicsUltimiSondaggi extends WidgetGraphic {

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        $this->setCode('ULTIMI_SONDAGGI_GRAPHIC');
        $this->setLabel(AmosSondaggi::tHtml('amossondaggi', 'Ultimi sondaggi'));
        $this->setDescription(AmosSondaggi::t('amossondaggi', 'Elenca gli ultimi sondaggi'));
    }

    /**
     * 
     * @return string
     */
    public function getHtml() {
        $search = new SondaggiSearch();
        $search->setNotifier(new NotifyWidgetDoNothing());


        $listaSondaggi = $search->ultimiSondaggi($_GET, 3);
        $viewToRender = 'ultimi_sondaggi';


        return $this->render($viewToRender, [
                    'lista' => $listaSondaggi,
                    'widget' => $this,
                    'toRefreshSectionId' => 'widgetGraphicSondaggi'
        ]);
    }

}
