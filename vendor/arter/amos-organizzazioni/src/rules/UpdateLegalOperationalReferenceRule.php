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
 * @package    arter\amos\organizzazioni\rules
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\organizzazioni\rules;

use arter\amos\core\rules\BasicContentRule;
use arter\amos\organizzazioni\models\Profilo;
use arter\amos\organizzazioni\models\ProfiloSedi;

/**
 * Class UpdateLegalOperationalReferenceRule
 * @package arter\amos\organizzazioni\rules
 */
class UpdateLegalOperationalReferenceRule extends BasicContentRule
{
    public $name = 'UpdateLegalOperationalReferenceRule';

    /**
     * @inheritdoc
     */
    public function ruleLogic($user, $item, $params, $model)
    {
        /** @var Profilo|ProfiloSedi $model */

        if (!($model instanceof Profilo) && !($model instanceof ProfiloSedi)) {
            return false;
        }

        /** @var Profilo $modelToCheck */
        $modelToCheck = $model;

        if ($model instanceof ProfiloSedi) {
            $modelToCheck = $model->profilo;
        }

        return in_array($user, [
            $modelToCheck->rappresentante_legale,
            $modelToCheck->referente_operativo
        ]);
    }
}
