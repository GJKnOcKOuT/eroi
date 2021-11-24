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
 * @package    arter\amos\news
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

/**
 * Handles the dropping of table `news_allegati`.
 */
class m170217_162908_drop_news_allegati_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        if ($this->db->schema->getTableSchema('news_allegati', true) !== null) {
            $this->dropForeignKey('fk_news_allegati_news1_idx', 'news_allegati');
            $this->dropTable('news_allegati');
        } else {
            echo "Nessuna cancellazione eseguita in quanto la tabella non esiste";
        }
        return true;
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        echo "m170217_162908_drop_news_allegati_table non può essere revertata";
        return true;
    }
}
