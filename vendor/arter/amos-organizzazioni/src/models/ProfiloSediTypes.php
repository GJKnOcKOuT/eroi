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
 * Class ProfiloSediTypes
 * This is the model class for table "profilo_sedi_types".
 * @package arter\amos\organizzazioni\models
 */
class ProfiloSediTypes extends \arter\amos\organizzazioni\models\base\ProfiloSediTypes
{
    const TYPE_LEGAL_HEADQUARTER = 1;
    const TYPE_OPERATIVE_HEADQUARTER = 2;

    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'name'
        ];
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->isNewRecord) {
            $this->active = 1;
            $this->read_only = 0;
        }
    }
}
