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
use arter\amos\community\models\Community;
use yii\db\Migration;

/**
 * Class m171219_111336_add_community_field_hits
 */
class m190410_101466_add_column_personalized extends Migration {

    /**
     * @inheritdoc
     */
    public function safeUp() {
        $table = $this->db->schema->getTableSchema(\arter\amos\community\models\CommunityAmosWidgetsMm::tableName());
        if (!isset($table->columns['personalized'])) {
            $this->addColumn(\arter\amos\community\models\CommunityAmosWidgetsMm::tableName(), 'personalized', $this->integer(1)->defaultValue(0)->after('amos_widgets_id'));
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $this->dropColumn(\arter\amos\community\models\CommunityAmosWidgetsMm::tableName(), 'personalized');
    }

}
