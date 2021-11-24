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

/**
 * Interface BaseContentModelInterface
 * @package arter\amos\core\interfaces
 */
interface BaseContentModelInterface
{
    /**
     * @return string The model title field value
     */
    public function getTitle();

    /**
     * @return string The model short description field value
     */
    public function getShortDescription();

    /**
     * @param bool $truncate If true the description will be truncated in order of your method implementation logic.
     * @return string The model description field value
     */
    public function getDescription($truncate);
}
