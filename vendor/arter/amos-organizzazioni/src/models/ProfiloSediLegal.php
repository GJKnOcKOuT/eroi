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
 * @package    arter\amos\organizzazioni\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\models;

/**
 * Class ProfiloSediLegal
 * @package arter\amos\organizzazioni\models
 */
class ProfiloSediLegal extends ProfiloSedi
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->isNewRecord) {
            $this->profilo_sedi_type_id = ProfiloSediTypes::TYPE_LEGAL_HEADQUARTER;
        }
    }
}
