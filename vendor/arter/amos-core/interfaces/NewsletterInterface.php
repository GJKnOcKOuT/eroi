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

use yii\db\ActiveQuery;

/**
 * Interface NewsletterInterface
 * @package arter\amos\core\interfaces
 */
interface NewsletterInterface
{
    /**
     * @return string
     */
    public function newsletterOrderByField();
    
    /**
     * @return string
     */
    public function newsletterPublishedStatus();
    
    /**
     * @param string $searchParam
     * @param ActiveQuery $query
     * @return ActiveQuery
     */
    public function newsletterSearchFilter($searchParam, $query);
    
    /**
     * @return string
     */
    public function newsletterContentTitle();
    
    /**
     * @return string
     */
    public function newsletterContentTitleField();
    
    /**
     * @return string
     */
    public function newsletterContentStatusField();
    
    /**
     * @return array
     */
    public function newsletterContentGridViewColumns();
    
    /**
     * @return array
     */
    public function newsletterSelectContentsGridViewColumns();
}
