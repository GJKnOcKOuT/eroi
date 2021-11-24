<?php

namespace arter\amos\documenti\i18n\grammar;

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\documenti\AmosDocumenti;

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

class DocumentsGrammar implements ModelGrammarInterface
{

    /**
     * @return string
     */
    public function getModelSingularLabel()
    {
        return AmosDocumenti::t('amosdocumenti', '#document');
    }

    /**
     * @inheritdoc
     */
    public function getModelLabel()
    {
        return AmosDocumenti::t('amosdocumenti', '#documents');
    }

    /**
     * @return mixed
     */
    public function getArticleSingular()
    {
        return AmosDocumenti::t('amosdocumenti', '#article_singular');
    }

    /**
     * @return mixed
     */
    public function getArticlePlural()
    {
        return AmosDocumenti::t('amosdocumenti', '#article_plural');
    }

    /**
     * @return string
     */
    public function getIndefiniteArticle()
    {
        return AmosDocumenti::t('amosdocumenti', '#article_indefinite');
    }
}