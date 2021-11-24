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
 * @package    arter\amos\core\models
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\models;

/**
 * Class DuplicateContentLog
 * This is the model class for table "duplicate_content_log".
 * @package arter\amos\core\models
 */
class DuplicateContentLog extends \arter\amos\core\models\base\DuplicateContentLog
{
    /**
     * @inheritdoc
     */
    public function representingColumn()
    {
        return [
            'model_classname',
            'source_model_id',
            'duplicate_model_id'
        ];
    }
}
