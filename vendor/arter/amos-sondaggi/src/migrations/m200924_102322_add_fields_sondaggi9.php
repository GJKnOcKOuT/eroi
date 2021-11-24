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
use yii\db\Schema;

/**
 * Class m200924_102322_add_fields_sondaggi9
 */
class m200924_102322_add_fields_sondaggi9 extends Migration
{
    const TABLE         = '{{%sondaggi}}';
    const TABLE_DOMANDE = '{{%sondaggi_domande}}';
    const TABLE_MAP     = '{{%sondaggi_map}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE, 'sondaggio_chiuso_frontend', $this->integer()->defaultValue(0)->after('status'));
        $this->addColumn(self::TABLE, 'thank_you_page_sondaggio_chiuso',
            $this->text()->after('sondaggio_chiuso_frontend'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE, 'sondaggio_chiuso_frontend');
        $this->dropColumn(self::TABLE, 'thank_you_page_sondaggio_chiuso');      
    }
}