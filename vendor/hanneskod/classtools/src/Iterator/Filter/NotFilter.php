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

/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace hanneskod\classtools\Iterator\Filter;

use hanneskod\classtools\Iterator\ClassIterator;
use hanneskod\classtools\Iterator\Filter;

/**
 * Negate a filter
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class NotFilter extends ClassIterator implements Filter
{
    use FilterTrait;

    /**
     * @var Filter Filter to negate
     */
    private $filter;

    /**
     * Register filter to negate
     *
     * @param Filter $filter
     */
    public function __construct(Filter $filter)
    {
        $this->filter = $filter;
    }

    /**
     * Get iterator for definitions not present in negated filter
     *
     * @return \Traversable
     */
    public function getIterator()
    {
        $filtered = iterator_to_array($this->filter->getIterator());
        foreach ($this->getBoundIterator() as $className => $reflectedClass) {
            if (!isset($filtered[$className])) {
                yield $className => $reflectedClass;
            }
        }
    }
}
