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
 * @package    arter\amos\utility\drivers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\drivers;

use arter\amos\utility\drivers\base\bcDriver;
use arter\amos\organizzazioni\widgets\icons\WidgetIconProfilo;
use arter\amos\organizzazioni\Module;

/**
 * 
 */
class bcDriverOrganizzazioni extends bcDriver {

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();

        $this->modelClassName = Module::classname(); // put here your model
        $this->widgetIconNames = [
            WidgetIconProfilo::getWidgetIconName() => WidgetIconProfilo::classname(),
        ];
    }

    /**
     * Put here your search queries
     */
    public function searchWidgetIconProfilo() {
        $organizzazioniModule = \Yii::$app->getModule(Module::getModuleName());
        $modelSearch = $organizzazioniModule->createModel('ProfiloSearch');
        $this->query = $modelSearch->search([]);
    }
    
}
