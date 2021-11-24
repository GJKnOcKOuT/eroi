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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m170620_010101_Admin_2_ADMIN extends Migration
{
    public function safeUp()
    {
        $this->execute('
        SET FOREIGN_KEY_CHECKS = 0;
        UPDATE `auth_item`       SET name=\'ADMIN\'      WHERE LOWER(name)     = \'admin\';
        UPDATE `auth_item_child` SET parent=\'ADMIN\'    WHERE LOWER(parent)   = \'admin\';            
        UPDATE `auth_assignment` SET item_name=\'ADMIN\' WHERE LOWER(item_name)= \'admin\';
        SET FOREIGN_KEY_CHECKS = 1;
        ');

        return true;
    }

    public function safeDown()
    {
        return true;
    }
}
