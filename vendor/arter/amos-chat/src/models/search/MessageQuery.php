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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\chat\models\search;

use yii\db\ActiveQuery;

/**
 * Class MessageQuery
 * @package arter\amos\chat\models\search
 */
class MessageQuery extends ActiveQuery
{
    public function init()
    {
        parent::init();
        $this->alias('m');
    }

    /**
     * @param $userId
     * @param $contactId
     * @return $this
     */
    public function between($userId, $contactId)
    {
        return $this->andWhere(['or',
            ['sender_id' => $contactId, 'receiver_id' => $userId, 'is_deleted_by_receiver' => false],
            ['sender_id' => $userId, 'receiver_id' => $contactId, 'is_deleted_by_sender' => false],
            ])
            ->innerJoin('user_profile profile1', 'profile1.user_id = receiver_id AND profile1.deleted_at IS NULL')
            ->innerJoin('user_profile profile2', 'profile2.user_id = sender_id AND profile2.deleted_at IS NULL')
            ->andWhere(['profile1.attivo' => 1])
            ->andWhere(['profile2.attivo' => 1]);
    }
}
