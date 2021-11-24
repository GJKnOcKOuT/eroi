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

use arter\amos\discussioni\models\base\DiscussioniCommenti as DiscussioniCommentiBase;
use yii\db\BaseActiveRecord;

/**
 * Class DiscussioniCommenti
 * This is the model class for table "discussioni_commenti".
 * @package arter\amos\discussioni\models
 * @deprecated from version 1.5.
 */
class DiscussioniCommenti extends DiscussioniCommentiBase
{
    /**
     * @see BaseActiveRecord::afterSave()
     *
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        $idTopic = $this->getDiscussioniRisposte()->one()['discussioni_topic_id'];
        DiscussioniTopic::findOne($idTopic)->save(FALSE);
        //TODO Per un comportamento standard elimino la spedizione di notifiche
        parent::afterSave($insert, $changedAttributes);
    }
}
