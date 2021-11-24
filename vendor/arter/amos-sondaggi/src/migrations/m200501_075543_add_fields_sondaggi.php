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
 * Class m200501_075543_add_fields_sondaggi
 */
class m200501_075543_add_fields_sondaggi extends Migration
{
    const TABLE          = '{{%sondaggi}}';
    const TABLE_DOMANDE  = '{{%sondaggi_domande}}';
    const TABLE_RISPOSTE = '{{%sondaggi_risposte}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn(self::TABLE_DOMANDE, 'introduzione_condizionata',
            $this->text()->defaultValue(null)->after('introduzione'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn(self::TABLE_DOMANDE, 'introduzione_condizionata');
    }
}