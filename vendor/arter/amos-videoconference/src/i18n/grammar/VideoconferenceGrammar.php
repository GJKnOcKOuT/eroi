<?php

namespace arter\amos\videoconference\i18n\grammar;

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\videoconference\AmosVideoconference;

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

class VideoconferenceGrammar implements ModelGrammarInterface
{

    /**
     * @return string
     */
    public function getModelSingularLabel()
    {
        return AmosVideoconference::t('amosvideoconference', '#videoconference_singular');
    }

    /**
     * @inheritdoc
     */
    public function getModelLabel()
    {
        return AmosVideoconference::t('amosvideoconference', '#videoconference_plural');
    }

    /**
     * @return mixed
     */
    public function getArticleSingular()
    {
        return AmosVideoconference::t('amosvideoconference', '#article_singular');
    }

    /**
     * @return mixed
     */
    public function getArticlePlural()
    {
        return AmosVideoconference::t('amosvideoconference', '#article_plural');
    }

    /**
     * @return string
     */
    public function getIndefiniteArticle()
    {
        return AmosVideoconference::t('amosvideoconference', '#article_indefinite');
    }
}