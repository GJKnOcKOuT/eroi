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


namespace Imagine\Factory;

/**
 * An interface that classes that accepts a class factory should implement.
 */
interface ClassFactoryAwareInterface
{
    /**
     * Set the class factory instance to be used.
     *
     * @param \Imagine\Factory\ClassFactoryInterface $classFactory
     *
     * @return $this
     */
    public function setClassFactory(ClassFactoryInterface $classFactory);

    /**
     * Get the class factory instance to be used.
     *
     * @return \Imagine\Factory\ClassFactoryInterface
     */
    public function getClassFactory();
}
