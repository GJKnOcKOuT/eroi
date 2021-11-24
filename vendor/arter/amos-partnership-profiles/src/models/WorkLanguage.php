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
 * @package    arter\amos\partnershipprofiles\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\partnershipprofiles\models;

/**
 * Class WorkLanguage
 * This is the model class for table "work_language".
 * @package arter\amos\partnershipprofiles\models
 */
class WorkLanguage extends \arter\amos\partnershipprofiles\models\base\WorkLanguage
{
    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'work_language'
        ];
    }
}
