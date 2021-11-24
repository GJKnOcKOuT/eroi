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
 * @package    arter\amos\report\migrations
 * @category   Migration
 * @author     Elite Division S.r.l.
 */

use arter\amos\core\migration\AmosMigrationTranslations;

/**
 * Class m170616_150319_add_report_new_modal_title_translation_IT
 */
class m170616_150319_add_report_new_modal_title_translation_IT extends AmosMigrationTranslations
{
    /**
     * @inheritdoc
     */
    protected function setTranslations()
    {
        return [
            self::LANG_IT => [
                [
                    'category' => 'amosreport',
                    'source' => 'You are sending a report for',
                    'translation' => 'Stai inviando una segnalazione per'
                ],
            ]
        ];
    }
}
