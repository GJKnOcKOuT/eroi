<?php

namespace arter\amos\news\i18n\grammar;

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\news\AmosNews;

/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    piattaforma-openinnovation
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

class NewsGrammar implements ModelGrammarInterface
{

    /**
     * @return string
     */
    public function getModelSingularLabel()
    {
        return AmosNews::t('amosnews', '#news_singular');
    }

    /**
     * @inheritdoc
     */
    public function getModelLabel()
    {
        return AmosNews::t('amosnews', '#news_plural');
    }

    /**
     * @return mixed
     */
    public function getArticleSingular()
    {
        return AmosNews::t('amosnews', '#article_singular');
    }

    /**
     * @return mixed
     */
    public function getArticlePlural()
    {
        return AmosNews::t('amosnews', '#article_plural');
    }

    /**
     * @return string
     */
    public function getIndefiniteArticle()
    {
        return AmosNews::t('amosnews', '#article_indefinite');
    }
}