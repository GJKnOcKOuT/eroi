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

namespace Symfony\Component\Console\Tests\Descriptor;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Descriptor\ApplicationDescription;

final class ApplicationDescriptionTest extends TestCase
{
    /**
     * @dataProvider getNamespacesProvider
     */
    public function testGetNamespaces(array $expected, array $names)
    {
        $application = new TestApplication();
        foreach ($names as $name) {
            $application->add(new Command($name));
        }

        $this->assertSame($expected, array_keys((new ApplicationDescription($application))->getNamespaces()));
    }

    public function getNamespacesProvider()
    {
        return [
            [['_global'], ['foobar']],
            [['a', 'b'], ['b:foo', 'a:foo', 'b:bar']],
            [['_global', 'b', 'z', 22, 33], ['z:foo', '1', '33:foo', 'b:foo', '22:foo:bar']],
        ];
    }
}

final class TestApplication extends Application
{
    /**
     * {@inheritdoc}
     */
    protected function getDefaultCommands()
    {
        return [];
    }
}
