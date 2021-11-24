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

/**
 * Class m170301_090817_alter_table_community_add_flags
 *
 * Create flag fields:
 * 'validated_once' : true if community has been validated at least one time
 * 'visible_on_edit': true if community must still be visible if is in editing status and validated_once is true
 */
class m170301_090817_alter_table_community_add_flags extends \yii\db\Migration
{
    const COMMUNITY = 'community';
    const VALIDATED_ONCE_FLAG = 'validated_once';
    const VISIBLE_ON_EDIT_FLAG = 'visible_on_edit';
    const FLAG_COLUMN_TYPE = 'TINYINT (1)';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(self::COMMUNITY, self::VALIDATED_ONCE_FLAG, self::FLAG_COLUMN_TYPE);
        $this->addColumn(self::COMMUNITY, self::VISIBLE_ON_EDIT_FLAG, self::FLAG_COLUMN_TYPE);
        return true;
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(self::COMMUNITY, self::VALIDATED_ONCE_FLAG);
        $this->dropColumn(self::COMMUNITY, self::VISIBLE_ON_EDIT_FLAG);
        return true;
    }
}
