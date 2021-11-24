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
 * @package    arter\amos\organizzazioni\controllers
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\controllers;

use arter\amos\organizzazioni\controllers\base\ProfiloController;

/**
 * Class DefaultController
 * @package arter\amos\organizzazioni\controllers
 */
class OrganizzazioniController extends ProfiloController
{

    /**
     * 
     * @param type $id
     */
    public function actionView($id){
        return $this->redirect(['/organizzazioni/profilo/view', 'id' => $id]);
    }
}
