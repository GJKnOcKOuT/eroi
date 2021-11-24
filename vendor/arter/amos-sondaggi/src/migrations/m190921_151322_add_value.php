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
 * Class m190921_151322_add_value
 */
class m190921_151322_add_value extends Migration
{
    const TABLE_MAP = '{{%sondaggi_map}}';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->insert(self::TABLE_MAP,
            [
            'campo' => 'email',
            'tabella' => 'user',
            'descrizione' => 'Email dell\'utente, campo del profilo.',
            'obbligatorio' => 1,
        ]);

        $this->insert(self::TABLE_MAP,
            [
            'campo' => 'nome',
            'tabella' => 'user_profile',
            'descrizione' => 'Nome dell\'utente, campo del profilo.',
            'obbligatorio' => 1,
        ]);

        $this->insert(self::TABLE_MAP,
            [
            'campo' => 'cognome',
            'tabella' => 'user_profile',
            'descrizione' => 'Cognome dell\'utente, campo del profilo.',
            'obbligatorio' => 1,
        ]);               

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete(self::TABLE_MAP);
        echo "Cancellazione dei contenuti avvenuta correttamente.";
        return true;
    }
}