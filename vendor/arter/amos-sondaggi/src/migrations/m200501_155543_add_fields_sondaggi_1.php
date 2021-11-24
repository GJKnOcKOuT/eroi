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
 * Class m200501_155543_add_fields_sondaggi_1
 */
class m200501_155543_add_fields_sondaggi_1 extends Migration
{
    const TABLE          = '{{%sondaggi}}';
    const TABLE_DOMANDE  = '{{%sondaggi_domande_tipologie}}';
    const TABLE_RISPOSTE = '{{%sondaggi_risposte}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute("
                    INSERT INTO `sondaggi_domande_tipologie` (`id`, `tipologia`, `descrizione`, `attivo`, `html_type`, `created_at`, `updated_at`, `deleted_at`, `created_by`, `updated_by`, `deleted_by`, `version`) VALUES
                    (12,	'Testo in sola visualizzazione',	'Testo in sola visualizzazione',	1,	'descrizione',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL);");
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        return true;
    }
}