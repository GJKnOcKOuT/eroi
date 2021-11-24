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
 * @package    arter\amos\myactivities\migrations
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

class m170726_094044_translation_add_label extends \arter\amos\core\migration\AmosMigrationTranslations
{
    const CATEGORY = 'amosmyactivities';

    /**
     * @inheritdoc
     */
    protected function setTranslations()
    {
        return [
            self::LANG_IT => [
                [
                    'category' => self::CATEGORY,
                    'source' => 'User validation request',
                    'translation' => 'Richiesta di validazione utente'
                ],//
            ]
        ];
    }
}