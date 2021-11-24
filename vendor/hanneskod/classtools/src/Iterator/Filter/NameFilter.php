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
 * Filter classes based on name
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class NameFilter extends ClassIterator implements Filter
{
    use FilterTrait;

    /**
     * @var string Regular expression for matching definition names
     */
    private $pattern;

    /**
     * Register matching regular expression
     *
     * @param string $pattern
     */
    public function __construct($pattern)
    {
        $this->pattern = $pattern;
    }

    /**
     * Get iterator for matching classnames
     *
     * @return \Traversable
     */
    public function getIterator()
    {
        foreach ($this->getBoundIterator() as $className => $reflectedClass) {
            if (preg_match($this->pattern, $className)) {
                yield $className => $reflectedClass;
            }
        }
    }
}
