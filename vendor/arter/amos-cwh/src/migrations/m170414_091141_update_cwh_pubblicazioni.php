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
 * @package    arter\amos\cwh
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use yii\db\Migration;

/**
 * Class m170414_091141_update_cwh_pubblicazioni
 */
class m170414_091141_update_cwh_pubblicazioni extends Migration
{
    const TABLE = '{{%cwh_regole_pubblicazione}}';

    public function safeUp()
    {
        $this->update(
            self::TABLE,
            [
                'nome' => 'Tutti gli utenti',
            ],
            [
                'id' => 1
            ]
        );
        $this->update(
            self::TABLE,
            [
                'nome' => 'Tutti gli utenti con specifici "tag aree di interesse"',
            ],
            [
                'id' => 2
            ]
        );
        $this->update(
            self::TABLE,
            [
                'nome' => 'Tutti gli utenti in determinati ambiti',
            ],
            [
                'id' => 3
            ]
        );
        $this->update(
            self::TABLE,
            [
                'nome' => 'Tutti gli utenti in determinati ambiti e con specifici "tag aree di interesse"',
            ],
            [
                'id' => 4
            ]
        );
    }

    public function safeDown()
    {
        echo "Down() non previsto per il file m170414_091141_update_cwh_pubblicazioni";
        return true;
    }
}
