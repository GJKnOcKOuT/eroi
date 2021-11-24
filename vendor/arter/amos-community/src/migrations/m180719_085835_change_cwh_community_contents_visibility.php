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
 * Class m180719_085835_change_cwh_community_contents_visibility
 */
class m180719_085835_change_cwh_community_contents_visibility extends Migration
{
    /**
     * string TABLENAME
     */
    const COMMUNITY = '{{%community}}';
    
    const CWH_CONFIG = '{{%cwh_config}}';
    
    const RAW_SQL_COMMUNITY = 'select 
concat(\'community-\',`community`.`id`) AS `id`,
3 AS `cwh_config_id`,
`community`.`id` AS `record_id`,
\'arter\\\\amos\\\\community\\\\models\\\\Community\' AS `classname`,
(CASE `community`.`community_type_id` WHEN 1 THEN 1 ELSE  0 END) AS `visibility`,
`community`.`created_at` AS `created_at`,
`community`.`updated_at` AS `updated_at`,
`community`.`deleted_at` AS `deleted_at`,
`community`.`created_by` AS `created_by`,
`community`.`updated_by` AS `updated_by`,
`community`.`deleted_by` AS `deleted_by` 

from `community`';
    const NEW_RAW_SQL_COMMUNITY = 'select 
concat(\'community-\',`community`.`id`) AS `id`,
3 AS `cwh_config_id`,
`community`.`id` AS `record_id`,
\'arter\\\\amos\\\\community\\\\models\\\\Community\' AS `classname`,
`community`.`contents_visibility` AS `visibility`,
`community`.`created_at` AS `created_at`,
`community`.`updated_at` AS `updated_at`,
`community`.`deleted_at` AS `deleted_at`,
`community`.`created_by` AS `created_by`,
`community`.`updated_by` AS `updated_by`,
`community`.`deleted_by` AS `deleted_by` 

from `community`';
    
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn(self::COMMUNITY, 'contents_visibility', $this->boolean()->notNull()->defaultValue(0)->after('hide_participants'));
        $tableSchema = $this->db->schema->getTableSchema(self::CWH_CONFIG);
        $rawSqlColumn = $tableSchema->getColumn('raw_sql');
        if (!is_null($rawSqlColumn)) {
            $this->update(self::CWH_CONFIG, ['raw_sql' => self::NEW_RAW_SQL_COMMUNITY], ['tablename' => \arter\amos\community\models\Community::tableName()]);
        }
        \arter\amos\cwh\utility\CwhUtil::createCwhView();
        return true;
    }
    
    public function safeDown()
    {
        $this->dropColumn(self::COMMUNITY, 'contents_visibility');
        $tableSchema = $this->db->schema->getTableSchema(self::CWH_CONFIG);
        $rawSqlColumn = $tableSchema->getColumn('raw_sql');
        if (!is_null($rawSqlColumn)) {
            $this->update(self::CWH_CONFIG, ['raw_sql' => self::RAW_SQL_COMMUNITY], ['tablename' => \arter\amos\community\models\Community::tableName()]);
        }
        \arter\amos\cwh\utility\CwhUtil::createCwhView();
        return true;
    }
}
