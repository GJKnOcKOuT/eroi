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
 * @package    arter\amos\utility\interfaces
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\utility\interfaces;

/**
 * Interface BaseContentModelInterface
 * @package arter\amos\core\interfaces
 */
interface bcDriverInterface
{
    /**
     * Execute queris for calculate bc by user and macro area
     */
    public function calculateBulletCounters();
    
    /**
     * Update bc table by user and relative widget icon
     * Find into amos_widgets the relative id
     * 
     * @param type $widget widget icon name
     */
    public function updateBulletCounters($widget = null, $namespace = null);
    
}
