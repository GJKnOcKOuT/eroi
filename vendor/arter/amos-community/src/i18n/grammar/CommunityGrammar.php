<?php

namespace  arter\amos\community\i18n\grammar;

use arter\amos\community\AmosCommunity;
use arter\amos\core\interfaces\ModelGrammarInterface;

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

class CommunityGrammar implements ModelGrammarInterface
{

    /**
     * @return string
     */
    public function getModelSingularLabel()
    {
        return AmosCommunity::t('amoscommunity', '#community');
    }

    /**
     * @return string The model name in translation label
     */
    public function getModelLabel()
    {
        return \Yii::t('amoscommunity','#Community');
    }

    /**
     * @return mixed
     */
    public function getArticleSingular()
    {
        return AmosCommunity::t('amoscommunity', '#article_singular');
    }

    /**
     * @return mixed
     */
    public function getArticlePlural()
    {
        return AmosCommunity::t('amoscommunity', '#article_plural');
    }

    /**
     * @return string
     */
    public function getIndefiniteArticle()
    {
        return AmosCommunity::t('amoscommunity', '#article_indefinite');
    }
}