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


interface WorkflowModelInterface
{

    /**
     * @return string The name that correspond to 'to validate' status for the content model
     */
    public function getToValidateStatus();

    /**
     * @return string The name that correspond to 'published' status for the content model
     */
    public function getValidatedStatus();

    /**
     * @return string The name that correspond to 'draft' status for the content model
     */
    public function getDraftStatus();

    /**
     * @return string The name of model validator role
     */
    public function getValidatorRole();

    /**
     * @return array list of statuses that for cwh is validated
     */
    public function getCwhValidationStatuses();



}