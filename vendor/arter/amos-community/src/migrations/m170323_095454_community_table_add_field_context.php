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
 * Add field 'context' to table community
 * context contains the creator model classname (eg. Community, Project management classname, events classname,..)
 * Class m170323_095454_community_table_add_field_context
 */
class m170323_095454_community_table_add_field_context extends Migration
{
    const COMMUNITY = 'community';

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(self::COMMUNITY, 'context', 'varchar(255)');
        $this->update(self::COMMUNITY, ['context' => \arter\amos\community\models\Community::className()]);
        return true;
    }
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn(self::COMMUNITY, 'context');
        return true;
    }
}
