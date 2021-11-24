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
 * @package    arter\amos\discussioni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\discussioni\models;

use arter\amos\discussioni\models\base\DiscussioniRisposte as DiscussioniRisposteBase;
use yii\db\BaseActiveRecord;

/**
 * Class DiscussioniRisposte
 * This is the model class for table "discussioni_risposte".
 * @package arter\amos\discussioni\models
 * @deprecated from version 1.5.
 */
class DiscussioniRisposte extends DiscussioniRisposteBase
{
    /**
     * @see BaseActiveRecord::afterSave()
     *
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes) {
        $this->getDiscussioniTopic()->one()->save(FALSE);
        //TODO Disabilito la spedizione delle notifiche in una situazione standard
        parent::afterSave($insert, $changedAttributes);
    }

}
