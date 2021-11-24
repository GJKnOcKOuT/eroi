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
 * @package    arter\amos\sondaggi\i18n\grammar
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\sondaggi\i18n\grammar;

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\sondaggi\AmosSondaggi;

/**
 * Class SondaggiGrammar
 * @package arter\amos\sondaggi\i18n\grammar
 */
class SondaggiGrammar implements ModelGrammarInterface
{
    /**
     * @inheritdoc
     */
    public function getModelSingularLabel()
    {
        return AmosSondaggi::t('amossondaggi', '#sondaggi_singular');
    }

    /**
     * @inheritdoc
     */
    public function getModelLabel()
    {
        return AmosSondaggi::t('amossondaggi', '#sondaggi_plural');
    }

    /**
     * @inheritdoc
     */
    public function getArticleSingular()
    {
        return AmosSondaggi::t('amossondaggi', '#sondaggi_article_singular');
    }

    /**
     * @inheritdoc
     */
    public function getArticlePlural()
    {
        return AmosSondaggi::t('amossondaggi', '#sondaggi_article_plural');
    }

    /**
     * @inheritdoc
     */
    public function getIndefiniteArticle()
    {
        return AmosSondaggi::t('amossondaggi', '#sondaggi_indefinite_article');
    }
}
