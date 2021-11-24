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
use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m190509_173600_add_rows_aster_profilo_enti_type
 */
class m190509_173600_add_rows_aster_profilo_enti_type extends Migration
{
    private $tableName = '';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->tableName = ProfiloEntiType::tableName();
    }

    public function safeUp()
    {
        $this->_safeTruncateTable();

        $this->batchInsert($this->tableName, [
            'id',
            'priority',
            'name',
        ], [
            [1, 1, '#accelerator-incubator'],
            [2, 2, '#cluster-association'],
            [3, 3, '#innovation-center'],
            [4, 4, '#fab-lab'],
            [5, 5, '#hi-tech-lab'],
            [6, 6, '#technological-center'],
        ]);

        return true;
    }

    public function safeDown()
    {
        $this->_safeTruncateTable();

        $this->execute(
            'INSERT INTO `profilo_enti_type` (`id`, `name`) VALUES
                    (1,	\'Comune (Amministratori e dipendenti comunali)\'),
                    (2,	\'Altro ente (Persone appartenenti a enti non comunali)\')'
        );

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
