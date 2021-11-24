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

use arter\amos\core\migration\libs\common\MigrationCommon;
use arter\amos\documenti\models\Documenti;
use yii\db\Migration;

/**
 * Class m170613_094811_update_documents_add_commentable_field
 */
class m170613_094811_update_documents_add_commentable_field extends Migration
{
    private $tablename;
    
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->tablename = Documenti::tableName();
    }
    
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        try {
            $this->addColumn($this->tablename, 'comments_enabled', $this->boolean()->defaultValue(0)->after('status'));
            $this->addColumn(Documenti::tableName(), 'parent_id', $this->integer()->null()->defaultValue(null)->after('comments_enabled'));
            $this->addColumn(Documenti::tableName(), 'is_folder', $this->boolean()->notNull()->defaultValue(0)->after('parent_id'));
            $this->addColumn(Documenti::tableName(), 'version', $this->integer()->null()->defaultValue(null)->after('is_folder'));
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage("Error while add column 'comments_enabled' to " . $this->tablename . " table");
            return false;
        }
        return true;
    }
    
    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        try {
            $this->dropColumn($this->tablename, 'comments_enabled');
            $this->dropColumn(Documenti::tableName(), 'parent_id');
            $this->dropColumn(Documenti::tableName(), 'is_folder');
            $this->dropColumn(Documenti::tableName(), 'version');
        } catch (\Exception $exception) {
            MigrationCommon::printConsoleMessage("Error while drop column 'comments_enabled' from " . $this->tablename . " table");
            return false;
        }
        return true;
    }
}
