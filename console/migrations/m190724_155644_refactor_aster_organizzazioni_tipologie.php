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

use arter\amos\organizzazioni\models\Profilo;
use arter\amos\organizzazioni\models\ProfiloEntiType;
use arter\amos\organizzazioni\models\ProfiloTypesPmi;
use yii\db\Expression;
use yii\db\Migration;
use yii\db\Query;

/**
 * Class m190724_155644_refactor_aster_organizzazioni_tipologie
 */
class m190724_155644_refactor_aster_organizzazioni_tipologie extends Migration
{
    const ADMIN_ID = 1;

    private $profiloTableName;
    private $profiloTypesPmiTableName;
    private $profiloEntiTypeTableName;

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->profiloTableName = Profilo::tableName();
        $this->profiloTypesPmiTableName = ProfiloTypesPmi::tableName();
        $this->profiloEntiTypeTableName = ProfiloEntiType::tableName();
    }

    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->addColumn($this->profiloTableName, 'tipologia_di_organizzazione_bck', $this->string(255)->null()->defaultValue(null)->after('tipologia_di_organizzazione'));
        $this->update($this->profiloTableName, ['tipologia_di_organizzazione_bck' => new Expression('tipologia_di_organizzazione')]);
        $this->update($this->profiloTableName, ['tipologia_di_organizzazione' => new Expression('profilo_enti_type_id')]);
        $sql = "CREATE TABLE `" . $this->profiloTypesPmiTableName . "_bck` LIKE `" . $this->profiloTypesPmiTableName . "`;";
        $this->execute($sql);
        $sql2 = "INSERT INTO `" . $this->profiloTypesPmiTableName . "_bck` SELECT * FROM `" . $this->profiloTypesPmiTableName . "`";
        $this->execute($sql2);
        $this->truncateTable($this->profiloTypesPmiTableName);
        $this->addColumn($this->profiloTypesPmiTableName, 'priority', $this->smallInteger()->null()->defaultValue(null)->after('name'));
        $query = new Query();
        $tipologie = $query->from($this->profiloEntiTypeTableName)->all();
        $toInsert = [];
        foreach ($tipologie as $tipologia) {
            $toInsert[] = [
                $tipologia['id'],
                $tipologia['name'],
                $tipologia['priority'],
                new Expression('NOW()'),
                new Expression('NOW()'),
                self::ADMIN_ID,
                self::ADMIN_ID
            ];
        }
        $this->batchInsert($this->profiloTypesPmiTableName, [
            'id',
            'name',
            'priority',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by'
        ], $toInsert);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropColumn($this->profiloTableName, 'tipologia_di_organizzazione');
        $this->renameColumn($this->profiloTableName, 'tipologia_di_organizzazione_bck', 'tipologia_di_organizzazione');
        $this->truncateTable($this->profiloTypesPmiTableName);
        $this->dropColumn($this->profiloTypesPmiTableName, 'priority');
        $query = new Query();
        $tipologie = $query->from($this->profiloTypesPmiTableName . '_bck')->all();
        $toInsert = [];
        foreach ($tipologie as $tipologia) {
            $tmp = [];
            foreach ($tipologia as $value) {
                $tmp[] = $value;
            }
            $toInsert[] = $tmp;
        }
        $this->batchInsert($this->profiloTypesPmiTableName, [
            'id',
            'name',
            'priority',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by'
        ], $toInsert);
        $this->dropTable($this->profiloTypesPmiTableName . '_bck');
        return true;
    }
}
