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
use hanneskod\classtools\Exception\LogicException;
use hanneskod\classtools\Iterator\SplFileInfo;

/**
 * Implementation of Filter
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
trait FilterTrait
{
    /**
     * @var ClassIterator Iterator filter is bound to
     */
    private $boundIterator;

    /**
     * Bind filter to iterator
     *
     * @param  ClassIterator $iterator
     * @return void
     */
    public function bindTo(ClassIterator $iterator)
    {
        $this->boundIterator = $iterator;
    }

    /**
     * Get iterator bound to filter
     *
     * @return ClassIterator
     * @throws LogicException If no bound iterator exists
     */
    public function getBoundIterator()
    {
        if (!isset($this->boundIterator)) {
            throw new LogicException("Filter not bound to iterator.");
        }
        return $this->boundIterator;
    }

    /**
     * Get map of classnames to SplFileInfo objects
     *
     * @return SplFileInfo[]
     */
    public function getClassMap()
    {
        $parentMap = $this->getBoundIterator()->getClassMap();
        $map = iterator_to_array($this->getIterator());

        foreach ($map as $name => &$fileinfo) {
            $fileinfo = $parentMap[$name];
        }

        return $map;
    }

    /**
     * Get current iterator
     *
     * @return \Traversable
     */
    abstract public function getIterator();
}
