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
 * @package    arter\amos\core\i18n\grammar
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\i18n\grammar;

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\core\module\BaseAmosModule;

/**
 * Class ContentModelGrammar
 * @package amos\results\i18n\grammar
 */
class ContentModelGrammar implements ModelGrammarInterface
{
    /**
     * @inheritdoc
     */
    public function getModelSingularLabel()
    {
        return BaseAmosModule::t('amoscore', 'contenuto');
    }

    /**
     * @inheritdoc
     */
    public function getModelLabel()
    {
        return BaseAmosModule::t('amoscore', 'contenuti');
    }

    /**
     * @inheritdoc
     */
    public function getArticleSingular()
    {
        return BaseAmosModule::t('amoscore', 'il');
    }

    /**
     * @inheritdoc
     */
    public function getArticlePlural()
    {
        return BaseAmosModule::t('amoscore', 'i');
    }

    /**
     * @inheritdoc
     */
    public function getIndefiniteArticle()
    {
        return BaseAmosModule::t('amoscore', 'un');
    }

}
