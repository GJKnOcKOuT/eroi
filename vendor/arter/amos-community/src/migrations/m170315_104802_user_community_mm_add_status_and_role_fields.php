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
 * @package    arter\amos\community\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

/**
 * Class m170315_104802_user_community_mm_add_status_and_role_fields
 */
class m170315_104802_user_community_mm_add_status_and_role_fields extends Migration
{
    const COMMUNITY_USER_MM = 'community_user_mm';
    const STATUS = 'status';
    const ROLE = 'role';
    const COLUMN_STATUS_TYPE = "VARCHAR(100) AFTER user_id " ;
    const COLUMN_ROLE_TYPE = "VARCHAR(100) AFTER status " ;

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(self::COMMUNITY_USER_MM, self::STATUS, self::COLUMN_STATUS_TYPE);
        $this->addColumn(self::COMMUNITY_USER_MM, self::ROLE, self::COLUMN_ROLE_TYPE);
        $this->update(self::COMMUNITY_USER_MM, [self::STATUS => 'ACTIVE']);
        $this->update(self::COMMUNITY_USER_MM, [self::ROLE => 'COMMUNITY_MANAGER']);

        return true;
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(self::COMMUNITY_USER_MM, self::ROLE);
        $this->dropColumn(self::COMMUNITY_USER_MM, self::STATUS);
        return true;
    }
}
