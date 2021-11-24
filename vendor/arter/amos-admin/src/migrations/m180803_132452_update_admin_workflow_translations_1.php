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
 * @package    arter\amos\admin\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTranslations;

/**
 * Class m180803_132452_update_admin_workflow_translations_1
 */
class m180803_132452_update_admin_workflow_translations_1 extends AmosMigrationTranslations
{
    const CATEGORY = 'amosadmin';

    /**
     * @inheritdoc
     */
    protected function setTranslations()
    {
        return [
            self::LANG_IT => [
                [
                    'update' => true,
                    'category' => self::CATEGORY,
                    'source' => '#NOTVALIDATED_message',
                    'oldTranslation' => 'Il profilo verrà rimesso in bozza per apportare le modifiche. Confermi?',
                    'newTranslation' => 'Confermi di rifiutare la validazione del profilo?'
                ]
            ]
        ];
    }
}
