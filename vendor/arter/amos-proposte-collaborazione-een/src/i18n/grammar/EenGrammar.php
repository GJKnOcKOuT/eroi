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
 * @package    arter\amos\een\i18n\grammar
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\een\i18n\grammar;

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\een\AmosEen;

/**
 * Class EenGrammar
 * @package arter\amos\een\i18n\grammar
 */
class EenGrammar implements ModelGrammarInterface
{
    /**
     * @return string
     */
    public function getModelSingularLabel()
    {
        return AmosEen::t('amoseen', '#een_singular');
    }
    
    /**
     * @inheritdoc
     */
    public function getModelLabel()
    {
        return AmosEen::t('amoseen', '#een_plural');
    }
    
    /**
     * @return mixed
     */
    public function getArticleSingular()
    {
        return AmosEen::t('amoseen', '#article_singular');
    }
    
    /**
     * @return mixed
     */
    public function getArticlePlural()
    {
        return AmosEen::t('amoseen', '#article_plural');
    }
    
    /**
     * @return string
     */
    public function getIndefiniteArticle()
    {
        return AmosEen::t('amoseen', '#article_indefinite');
    }
}
