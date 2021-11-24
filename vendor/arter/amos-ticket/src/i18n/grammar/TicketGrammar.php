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
 * @package    arter\amos\ticket\i18n\grammar
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\ticket\i18n\grammar;

use arter\amos\core\interfaces\ModelGrammarInterface;
use arter\amos\ticket\AmosTicket;

/**
 * Class TicketGrammar
 * @package arter\amos\ticket\i18n\grammar
 */
class TicketGrammar implements ModelGrammarInterface
{
    /**
     * @return string
     */
    public function getModelSingularLabel()
    {
        return AmosTicket::t('amosticket', '#ticket_singular');
    }

    /**
     * @inheritdoc
     */
    public function getModelLabel()
    {
        return AmosTicket::t('amosticket', '#ticket_plural');
    }

    /**
     * @return mixed
     */
    public function getArticleSingular()
    {
        return AmosTicket::t('amosticket', '#article_singular');
    }

    /**
     * @return mixed
     */
    public function getArticlePlural()
    {
        return AmosTicket::t('amosticket', '#article_plural');
    }

    /**
     * @return string
     */
    public function getIndefiniteArticle()
    {
        return AmosTicket::t('amosticket', '#article_indefinite');
    }
}
