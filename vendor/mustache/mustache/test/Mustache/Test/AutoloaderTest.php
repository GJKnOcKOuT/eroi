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

/**
 * @group unit
 */
class Mustache_Test_AutoloaderTest extends PHPUnit_Framework_TestCase
{
    public function testRegister()
    {
        $loader = Mustache_Autoloader::register();
        $this->assertTrue(spl_autoload_unregister(array($loader, 'autoload')));
    }

    public function testAutoloader()
    {
        $loader = new Mustache_Autoloader(dirname(__FILE__) . '/../../fixtures/autoloader');

        $this->assertNull($loader->autoload('NonMustacheClass'));
        $this->assertFalse(class_exists('NonMustacheClass'));

        $loader->autoload('Mustache_Foo');
        $this->assertTrue(class_exists('Mustache_Foo'));

        $loader->autoload('\Mustache_Bar');
        $this->assertTrue(class_exists('Mustache_Bar'));
    }

    /**
     * Test that the autoloader won't register multiple times.
     */
    public function testRegisterMultiple()
    {
        $numLoaders = count(spl_autoload_functions());

        Mustache_Autoloader::register();
        Mustache_Autoloader::register();

        $expectedNumLoaders = $numLoaders + 1;

        $this->assertCount($expectedNumLoaders, spl_autoload_functions());
    }
}
