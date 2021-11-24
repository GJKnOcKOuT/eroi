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

/**
 * @link http://phe.me
 * @copyright Copyright (c) 2014 Pheme
 * @license MIT http://opensource.org/licenses/MIT
 */

use yii\db\Migration;

class m151126_091910_add_unique_index extends Migration
{
    public function safeUp()
    {
        $this->createIndex('settings_unique_key_section', '{{%settings}}', ['section', 'key'], true);
    }

    public function safeDown()
    {
        $this->dropIndex('settings_unique_key_section', '{{%settings}}');
    }
}
