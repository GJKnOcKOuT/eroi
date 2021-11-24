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
use yii\db\Migration;

/**
 * Class m171206_092631_add_documenti_fields_1
 */
class m171206_092631_add_documenti_fields_1 extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        /*$this->addColumn(Documenti::tableName(), 'parent_id', $this->integer()->null()->defaultValue(null)->after('comments_enabled'));
        $this->addColumn(Documenti::tableName(), 'is_folder', $this->boolean()->notNull()->defaultValue(0)->after('parent_id'));
        $this->addColumn(Documenti::tableName(), 'version', $this->integer()->null()->defaultValue(null)->after('is_folder'));*/
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        /*$this->dropColumn(Documenti::tableName(), 'parent_id');
        $this->dropColumn(Documenti::tableName(), 'is_folder');
        $this->dropColumn(Documenti::tableName(), 'version');*/
        return true;
    }
}
