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

use arter\amos\partnershipprofiles\models\base\DevelopmentStage;
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m190508_183600_add_row_prototype_aster_development_stage
 */
class m190508_183600_add_row_prototype_aster_development_stage extends Migration
{
    const ADMIN_ID = 1;

    private $tableName = '';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = DevelopmentStage::tableName();
    }

    public function safeUp()
    {
        $this->_safeClean();
        $this->batchInsert($this->tableName, [
            'id',
            'value',
            'priority',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ], [
            [
                5,
                'Prototype',
                4,
                new Expression('NOW()'),
                new Expression('NOW()'),
                self::ADMIN_ID,
                self::ADMIN_ID
            ],
        ]);

        $this->update($this->tableName, ['priority' => 1], ['id' => 3]);
        $this->update($this->tableName, ['priority' => 2], ['id' => 4]);
        $this->update($this->tableName, ['priority' => 3], ['id' => 2]);
        $this->update($this->tableName, ['priority' => 5], ['id' => 1]);

        return true;
    }

    public function safeDown()
    {
        $this->_safeClean();
        return true;
    }

    private function _safeClean(){
        if ($this->db->driverName === 'mysql') {
            $this->execute("SET FOREIGN_KEY_CHECKS = 0;");
        }
        $this->delete($this->tableName, ['in', 'id', 5]);
        $this->update($this->tableName, ['priority' => 0]);

        if ($this->db->driverName === 'mysql') {
            $this->execute("SET FOREIGN_KEY_CHECKS = 1;");
        }
    }
}
