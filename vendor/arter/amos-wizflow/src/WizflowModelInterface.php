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
 * @package    arter\amos\wizflow
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\wizflow;

/**
 * Interface WizflowModelInterface
 * Interface that must be implemented by all models used by the wizflow manager component
 * @package arter\amos\wizflow
 */
interface WizflowModelInterface
{
    /**
     * Returns a string description of the model. This string is used to display user choices
     * @return string description of the model attributes
     */
    public function summary();
}
