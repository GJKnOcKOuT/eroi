<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


use yii\db\Migration;

/**
 * Class m190225_101028_new_Event_inviation_sizes
 */
class m190225_101028_new_Event_inviation_sizes extends Migration
{
    public static $tableName = '{{%event_invitation}}';
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
           $this->alterColumn(self::$tableName, 'name', $this->string(50));
           $this->alterColumn(self::$tableName, 'surname', $this->string(50));
           
           return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn(self::$tableName, 'name', $this->string(16));
        $this->alterColumn(self::$tableName, 'surname', $this->string(16));

        return true;
    }
}
