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
 * Class m190705_124927_new_utf8mb4_bin_collate
 */
class m190705_124927_new_utf8mb4_bin_collate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableName = '{{%amoschat_message}}';
        
        $db = Yii::$app->getDb();
        $db->createCommand("ALTER TABLE $tableName CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_bin")->execute();
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $tableName = '{{%amoschat_message}}';
        
        $db = Yii::$app->getDb();
        $db->createCommand("ALTER TABLE $tableName CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci")->execute();
        return true;
    }

    
}
