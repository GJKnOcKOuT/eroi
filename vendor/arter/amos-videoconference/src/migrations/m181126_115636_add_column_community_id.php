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

use arter\amos\videoconference\models\Videoconf;
use yii\db\Migration;

/**
 * Class m171219_111336_add_community_field_hits
 */
class m181126_115636_add_column_community_id extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(Videoconf::tableName(), 'community_id', $this->integer()->defaultValue(null)->comment('Community')->after('reminder_sent'));
        $this->addForeignKey('fk_videoconf_community_id1', Videoconf::tableName(), 'community_id', 'community', 'id');

    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->execute('SET FOREIGN_KEY_CHECKS = 0;');
        $this->dropColumn(Videoconf::tableName(), 'community_id');
        $this->execute('SET FOREIGN_KEY_CHECKS = 1;');


    }
}
