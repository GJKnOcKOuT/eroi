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
 * Class m170502_132621_add_parent_id_field_to_community
 */
class m170502_132621_add_parent_id_field_to_community extends Migration
{
    const COMMUNITY = 'community';
    const PARENT_ID_FIELD = 'parent_id';
    const ID_COLUMN_TYPE = 'INT(11)';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(self::COMMUNITY, self::PARENT_ID_FIELD, self::ID_COLUMN_TYPE);

    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(self::COMMUNITY, self::PARENT_ID_FIELD);
        return true;
    }
}
