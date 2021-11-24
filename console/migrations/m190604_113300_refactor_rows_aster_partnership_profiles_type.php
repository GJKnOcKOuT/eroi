<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter\platform\common\console\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\organizzazioni\models\base\ProfiloEntiType;
use arter\amos\partnershipprofiles\models\base\PartnershipProfilesType;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m190604_113300_refactor_rows_aster_partnership_profiles_type
 */
class m190604_113300_refactor_rows_aster_partnership_profiles_type extends Migration
{
    private $tableName = '';
    const ADMIN_ID = 1;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = PartnershipProfilesType::tableName();
    }

    public function safeUp()
    {
        $now = new Expression('NOW()');
        $this->_safeTruncateTable();

        $this->batchInsert($this->tableName, [
            'id',
            'name',
            'description',
            'priority',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ], [
            [1, '#licenza', null, 1, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
            [2, '#collaborazione-tecnica', null, 2, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
            [3, '#joint-venture', null, 3, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
            [4, '#subfornitura', null, 4, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
            [5, '#ricerca', null, 5, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
        ]);

        return true;
    }

    public function safeDown()
    {
        $now = new Expression('NOW()');
        $this->_safeTruncateTable();

        $this->batchInsert($this->tableName, [
            'id',
            'name',
            'description',
            'priority',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ], [
            [1, 'Research', null, 1, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
            [2, 'Technical collaboration', null, 2, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
            [3, 'License', null, 3, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
            [4, 'Joint Venture', null, 4, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
            [5, 'Subcontracting', null, 5, $now, $now, self::ADMIN_ID, self::ADMIN_ID],
        ]);

        return true;
    }


    private function _safeTruncateTable() {
        if ($this->db->driverName === 'mysql') {
            $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
        }

        $this->truncateTable($this->tableName);

        if ($this->db->driverName === 'mysql') {
            $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
        }
    }
}
