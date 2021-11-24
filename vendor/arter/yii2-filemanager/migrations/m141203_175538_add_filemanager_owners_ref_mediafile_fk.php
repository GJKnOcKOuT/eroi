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

class m141203_175538_add_filemanager_owners_ref_mediafile_fk extends Migration
{
    public function up()
    {
        $this->addForeignKey(
            'filemanager_owners_ref_mediafile',
            'filemanager_owners',
            'mediafile_id',
            'filemanager_mediafile',
            'id',
            'RESTRICT',
            'RESTRICT'
        );
    }

    public function down()
    {
        $this->dropForeignKey('filemanager_owners_ref_mediafile', 'filemanager_owners');
    }
}
