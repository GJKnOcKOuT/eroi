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

class m160616_000010_add_filemanager_tags extends Migration
{
    public function up()
    {
        $this->createTable('filemanager_tag', [
            'id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
        ]);

        $this->createTable('filemanager_mediafile_tag', [
            'mediafile_id' => $this->integer()->notNull(),
            'tag_id' => $this->integer()->notNull(),
        ]);

        $this->addForeignKey(
            'filemanager_mediafile_tag_mediafile_id__mediafile_id',
            'filemanager_mediafile_tag',
            'mediafile_id',
            'filemanager_mediafile',
            'id',
            'CASCADE',
            'CASCADE'
            );
        $this->addForeignKey(
            'filemanager_mediafile_tag_tag_id__tag_id',
            'filemanager_mediafile_tag',
            'tag_id',
            'filemanager_tag',
            'id',
            'CASCADE',
            'CASCADE'
        );
    }

    public function down()
    {
        $this->dropTable('filemanager_mediafile_tag');
        $this->dropTable('filemanager_tag');
    }
}
