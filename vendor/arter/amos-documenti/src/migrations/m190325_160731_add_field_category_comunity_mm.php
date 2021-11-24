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
 * @package    arter\amos\documenti\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\documenti\models\Documenti;
use arter\amos\documenti\models\DocumentiCategoryCommunityMm;
use yii\db\Migration;

/**
 * Class m171206_092631_add_documenti_fields_1
 */
class m190325_160731_add_field_category_comunity_mm extends Migration {

    /**
     * @inheritdoc
     */
    public function safeUp() {
        $table = $this->db->schema->getTableSchema(DocumentiCategoryCommunityMm::tableName());
        
        if (!(isset($table->columns['visible_to_cm']))) {
            $this->addColumn(DocumentiCategoryCommunityMm::tableName(), 'visible_to_cm', $this->integer(1)->null()->defaultValue(null)->after('community_id'));
            $this->addColumn(DocumentiCategoryCommunityMm::tableName(), 'visible_to_participant', $this->integer(1)->null()->defaultValue(1)->after('community_id'));
        }
    }

    /**
     * @inheritdoc
     */
    public function safeDown() {
        $this->dropColumn(\arter\amos\documenti\models\DocumentiCategoryCommunityMm::tableName(), 'visible_to_cm');
        $this->dropColumn(\arter\amos\documenti\models\DocumentiCategoryCommunityMm::tableName(), 'visible_to_participant');
    }

}
