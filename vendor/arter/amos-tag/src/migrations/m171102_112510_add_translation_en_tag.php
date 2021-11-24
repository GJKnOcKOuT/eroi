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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

class m171102_112510_add_translation_en_tag extends \yii\db\Migration
{

    public function safeUp()
    {

        $this->addColumn(\arter\amos\tag\models\Tag::tableName(), 'nome_en',
            $this->text()
                ->null()
                ->after('nome')
        );

        $this->addColumn(\arter\amos\tag\models\Tag::tableName(), 'descrizione_en',
            $this->string(255)
                ->null()
                ->after('descrizione')
        );

        return true;
    }

    public function safeDown()
    {
        $this->dropColumn(\arter\amos\tag\models\Tag::tableName(), 'nome_en');
        $this->dropColumn(\arter\amos\tag\models\Tag::tableName(), 'descrizione_en');

        return true;
    }
}
