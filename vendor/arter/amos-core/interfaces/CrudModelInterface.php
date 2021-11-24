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
 * Interface CrudModelInterface
 * @package arter\amos\core\interfaces
 */
interface CrudModelInterface extends ViewModelInterface
{
    /**
     * @return string The url to create a single model
     */
    public function getCreateUrl();

    /**
     * @return string The url to "create" action for this model
     */
    public function getFullCreateUrl();

    /**
     * @return string The url to update a single model
     */
    public function getUpdateUrl();

    /**
     * @return string The url to "update" action for this model
     */
    public function getFullUpdateUrl();

    /**
     * @return string The url to delete a single model
     */
    public function getDeleteUrl();

    /**
     * @return string The url to "delete" action for this model
     */
    public function getFullDeleteUrl();
}
