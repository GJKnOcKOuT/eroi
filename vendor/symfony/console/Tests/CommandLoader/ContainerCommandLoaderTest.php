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
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Tests\CommandLoader;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\CommandLoader\ContainerCommandLoader;
use Symfony\Component\DependencyInjection\ServiceLocator;

class ContainerCommandLoaderTest extends TestCase
{
    public function testHas()
    {
        $loader = new ContainerCommandLoader(new ServiceLocator([
            'foo-service' => function () { return new Command('foo'); },
            'bar-service' => function () { return new Command('bar'); },
        ]), ['foo' => 'foo-service', 'bar' => 'bar-service']);

        $this->assertTrue($loader->has('foo'));
        $this->assertTrue($loader->has('bar'));
        $this->assertFalse($loader->has('baz'));
    }

    public function testGet()
    {
        $loader = new ContainerCommandLoader(new ServiceLocator([
            'foo-service' => function () { return new Command('foo'); },
            'bar-service' => function () { return new Command('bar'); },
        ]), ['foo' => 'foo-service', 'bar' => 'bar-service']);

        $this->assertInstanceOf(Command::class, $loader->get('foo'));
        $this->assertInstanceOf(Command::class, $loader->get('bar'));
    }

    public function testGetUnknownCommandThrows()
    {
        $this->expectException('Symfony\Component\Console\Exception\CommandNotFoundException');
        (new ContainerCommandLoader(new ServiceLocator([]), []))->get('unknown');
    }

    public function testGetCommandNames()
    {
        $loader = new ContainerCommandLoader(new ServiceLocator([
            'foo-service' => function () { return new Command('foo'); },
            'bar-service' => function () { return new Command('bar'); },
        ]), ['foo' => 'foo-service', 'bar' => 'bar-service']);

        $this->assertSame(['foo', 'bar'], $loader->getNames());
    }
}
