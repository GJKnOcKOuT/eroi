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
 * @package    arter\amos\admin\i18n\grammar
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\admin\i18n\grammar;

use arter\amos\admin\AmosAdmin;
use arter\amos\core\interfaces\ModelGrammarInterface;

/**
 * Class UserProfileGrammar
 * @package arter\amos\admin\i18n\grammar
 */
class UserProfileGrammar implements ModelGrammarInterface
{
    /**
     * @return string The singular model name in translation label
     */
    public function getModelSingularLabel()
    {
        return AmosAdmin::t('amosadmin', '#user_profile_singular');
    }
    
    /**
     * @return string The model name in translation label
     */
    public function getModelLabel()
    {
        return AmosAdmin::t('amosadmin', '#user_profile_plural');
    }
    
    /**
     * @return string
     */
    public function getArticleSingular()
    {
        return AmosAdmin::t('amosadmin', '#article_singular');
    }
    
    /**
     * @return string
     */
    public function getArticlePlural()
    {
        return AmosAdmin::t('amosadmin', '#article_plural');
    }
    
    /**
     * @return string
     */
    public function getIndefiniteArticle()
    {
        return AmosAdmin::t('amosadmin', '#article_indefinite');
    }
}
