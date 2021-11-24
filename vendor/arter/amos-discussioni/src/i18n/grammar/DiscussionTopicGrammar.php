<?php

namespace arter\amos\discussioni\i18n\grammar;

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\discussioni\AmosDiscussioni;

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

class DiscussionTopicGrammar implements ModelGrammarInterface
{

    /**
     * @return string
     */
    public function getModelSingularLabel()
    {
        return AmosDiscussioni::t('amosdiscussioni', '#discussion_topic');
    }

    /**
     * @inheritdoc
     */
    public function getModelLabel()
    {
        return AmosDiscussioni::t('amosdiscussioni', '#discussions_topic');
    }

    /**
     * @return mixed
     */
    public function getArticleSingular()
    {
        return AmosDiscussioni::t('amosdiscussioni', '#article_singular');
    }

    /**
     * @return mixed
     */
    public function getArticlePlural()
    {
        return AmosDiscussioni::t('amosdiscussioni', '#article_plural');
    }

    /**
     * @return string
     */
    public function getIndefiniteArticle()
    {
        return AmosDiscussioni::t('amosdiscussioni', '#article_indefinite');
    }
}