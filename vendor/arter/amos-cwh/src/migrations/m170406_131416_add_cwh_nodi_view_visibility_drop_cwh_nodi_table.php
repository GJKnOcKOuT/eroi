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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */
use arter\amos\cwh\models\CwhConfig;
use yii\db\Migration;

/**
 * Class m170406_131416_add_cwh_nodi_view_visibility_drop_cwh_nodi_table
 */
class m170406_131416_add_cwh_nodi_view_visibility_drop_cwh_nodi_table extends Migration
{
    const TABLE = '{{%cwh_nodi}}';

    public function safeUp()
    {

        if(Yii::$app->db->schema->getTableSchema(self::TABLE) !== null) { // IF cwh_nodi exists
            $this->execute("SET FOREIGN_KEY_CHECKS=0;");
            $this->dropTable(self::TABLE);
            $this->execute("SET FOREIGN_KEY_CHECKS=1;");
        }

        $listaConf = CwhConfig::find()->asArray()->all();

        $sqlSelect = '( ';
        $numeroConf = count($listaConf);
        $i = 1;
        foreach ($listaConf as $conf){
            $sqlSelect .= $conf['raw_sql'];
            if ($i < $numeroConf) {
                $sqlSelect .= ' ) UNION ( ';
            }
            $i++;
        }
        $sqlSelect .= ' );';

        $sql = 'CREATE OR REPLACE VIEW cwh_nodi_view AS ' . $sqlSelect;

        $commandSql = Yii::$app->getDb()->createCommand($sql);
        $commandSql->execute();

        return true;
    }

    public function safeDown()
    {

        return true;
    }

}
