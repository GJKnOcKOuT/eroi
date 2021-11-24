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
 * @package    arter\amos\partnershipprofiles\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

class m181221_102001_drop_unique_table extends Migration
{
    public function safeUp()
    {
        $this->dropIndex('idx-classname-content_id','seo_data');
        $this->dropIndex('pretty_url','seo_data');
        $this->createIndex(
            'idx-classname-content_id',
            'seo_data',
            'classname,content_id'
        );

    }

    public function safeDown()
    {
        return true;
//        $this->createIndex(
//            'idx-classname-content_id',
//            'seo_data',
//            'classname,content_id',
//            true //unique
//        );
    }
}