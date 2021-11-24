<?php

namespace arter\amos\events\i18n\grammar;

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\events\AmosEvents;

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

class EventGrammar implements ModelGrammarInterface
{

    /**
     * @return string
     */
    public function getModelSingularLabel()
    {
        return AmosEvents::t('amosevents', '#event');
    }

    /**
     * @inheritdoc
     */
    public function getModelLabel()
    {
        return AmosEvents::t('amosevents', '#events');
    }

    /**
     * @return mixed
     */
    public function getArticleSingular()
    {
        return AmosEvents::t('amosevents', '#article_singular');
    }

    /**
     * @return mixed
     */
    public function getArticlePlural()
    {
        return AmosEvents::t('amosevents', '#article_plural');
    }

    /**
     * @return string
     */
    public function getIndefiniteArticle()
    {
        return AmosEvents::t('amosevents', '#article_indefinite');
    }
}