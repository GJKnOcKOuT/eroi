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
 * Interface WorkflowMetadataInterface
 * @package arter\amos\core\interfaces
 */
interface WorkflowMetadataInterface
{
    /**
     * @return string The key to be used to search the status label in the model workflow metadata.
     */
    public function getMetadataLabelKey();

    /**
     * @return string The key to be used to search the status button label in the model workflow metadata.
     */
    public function getMetadataButtonLabelKey();

    /**
     * @return string The key to be used to search the status description in the model workflow metadata.
     */
    public function getMetadataDescriptionKey();

    /**
     * @return string The key to be used to search the status button data confirm message in the model workflow metadata.
     */
    public function getMetadataButtonMessageKey();
}
