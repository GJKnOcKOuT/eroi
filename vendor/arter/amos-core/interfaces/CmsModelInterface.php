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
 * @package    arter\amos\core\interfaces
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\interfaces;


interface CmsModelInterface {
     /**
     * Search method useful to retrieve data to show in frontend (with cms)
     * 
     * @param $params
     * @param int|null $limit
     * @return ActiveDataProvider 
     */
    public function cmsSearch($params, $limit);
    
    /**
     * return a list of fields that can be shown in frontend pages made by cms. For each field , also the field type is specified. 
     * In "Backend modules" cms section, user can choose to show only some of these fields.
     * 
     * @return array An array of arter\amos\core\record\CmsField objects
     */
    public function cmsViewFields() ;
    
     /**
     * return the list of fields to search for in frontend pages made by cms.For each field , also the field type is specified. 
     * 
     * @return array An array of arter\amos\core\record\CmsField objects
     */
    public function cmsSearchFields();
    
    /**
     * Method to know if the module can be viewed from the frontend
     * 
     * @param int $id
     * @return boolean 
     */
    public function cmsIsVisible($id);

}
