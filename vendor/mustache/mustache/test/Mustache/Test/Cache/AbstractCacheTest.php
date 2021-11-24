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
 * This file is part of Mustache.php.
 *
 * (c) 2010-2017 Justin Hileman
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class Mustache_Test_Cache_AbstractCacheTest extends PHPUnit_Framework_TestCase
{
    public function testGetSetLogger()
    {
        $cache  = new CacheStub();
        $logger = new Mustache_Logger_StreamLogger('php://stdout');
        $cache->setLogger($logger);
        $this->assertSame($logger, $cache->getLogger());
    }

    /**
     * @expectedException Mustache_Exception_InvalidArgumentException
     */
    public function testSetLoggerThrowsExceptions()
    {
        $cache  = new CacheStub();
        $logger = new StdClass();
        $cache->setLogger($logger);
    }
}

class CacheStub extends Mustache_Cache_AbstractCache
{
    public function load($key)
    {
        // nada
    }

    public function cache($key, $value)
    {
        // nada
    }
}
