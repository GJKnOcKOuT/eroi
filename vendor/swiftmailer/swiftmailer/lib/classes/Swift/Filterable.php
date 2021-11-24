<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see https://repo.art-er.it Developers' community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */


/*
 * This file is part of SwiftMailer.
 * (c) 2004-2009 Chris Corbyn
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Allows StreamFilters to operate on a stream.
 *
 * @author Chris Corbyn
 */
interface Swift_Filterable
{
    /**
     * Add a new StreamFilter, referenced by $key.
     *
     * @param string $key
     */
    public function addFilter(Swift_StreamFilter $filter, $key);

    /**
     * Remove an existing filter using $key.
     *
     * @param string $key
     */
    public function removeFilter($key);
}
