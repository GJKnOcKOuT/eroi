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
use ReflectionException;

/**
 * Filter classes of a spefcified type
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class TypeFilter extends ClassIterator implements Filter
{
    use FilterTrait;

    /**
     * @var string Name of type
     */
    private $typename;

    /**
     * Register name of type
     *
     * @param string $typename
     */
    public function __construct($typename)
    {
        $this->typename = $typename;
    }

    /**
     * Get iterator for definitions of type
     *
     * @return \Traversable
     */
    public function getIterator()
    {
        foreach ($this->getBoundIterator() as $className => $reflectedClass) {
            try {
                if ($reflectedClass->implementsInterface($this->typename)) {
                    yield $className => $reflectedClass;
                }
            } catch (ReflectionException $e) {
                try {
                    if (
                        $reflectedClass->isSubclassOf($this->typename)
                        || $reflectedClass->getName() == $this->typename
                    ) {
                        yield $className => $reflectedClass;
                    }
                } catch (ReflectionException $e) {
                    // Nope
                }
            }
        }
    }
}
