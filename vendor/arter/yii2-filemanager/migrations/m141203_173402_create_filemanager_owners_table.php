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


use yii\db\Schema;
use yii\db\Migration;

class m141203_173402_create_filemanager_owners_table extends Migration
{
    public function up()
    {
        $this->createTable('filemanager_owners', [
            'mediafile_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'owner_id' => Schema::TYPE_INTEGER . ' NOT NULL',
            'owner' => Schema::TYPE_STRING . ' NOT NULL',
            'owner_attribute' => Schema::TYPE_STRING . ' NOT NULL',
            'PRIMARY KEY (`mediafile_id`, `owner_id`, `owner`, `owner_attribute`)',
        ]);
    }

    public function down()
    {
        $this->dropTable('filemanager_owners');
    }
}
