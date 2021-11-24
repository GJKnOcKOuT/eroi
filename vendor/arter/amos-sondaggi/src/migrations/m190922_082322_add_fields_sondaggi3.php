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
 * Class m190922_082322_add_fields_sondaggi3
 */
class m190922_082322_add_fields_sondaggi3 extends Migration
{
    const TABLE         = '{{%sondaggi}}';
    const TABLE_DOMANDE = '{{%sondaggi_domande}}';
    const TABLE_MAP     = '{{%sondaggi_map}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {       
        $this->addColumn(self::TABLE, 'url_chiudi_sondaggio', $this->text()->defaultValue(null)->after('url_sondaggio_non_compilabile'));
       
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {        
        $this->dropColumn(self::TABLE, 'url_chiudi_sondaggio');
    }
}