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

class m170605_073900_add_news_slug extends Migration
{

    public function safeUp()
    {

        $this->addColumn(\arter\amos\news\models\News::tableName(), 'slug',
            $this->text()
                ->null()
                ->after('id')
        );

        return true;
    }

    public function safeDown()
    {
        $this->dropColumn(\arter\amos\news\models\News::tableName(), 'slug');

        return true;
    }
}
