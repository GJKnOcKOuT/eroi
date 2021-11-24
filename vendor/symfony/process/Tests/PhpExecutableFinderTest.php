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

namespace Symfony\Component\Process\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Process\PhpExecutableFinder;

/**
 * @author Robert Schönthal <seroscho@googlemail.com>
 */
class PhpExecutableFinderTest extends TestCase
{
    /**
     * tests find() with the constant PHP_BINARY.
     */
    public function testFind()
    {
        if (\defined('HHVM_VERSION')) {
            $this->markTestSkipped('Should not be executed in HHVM context.');
        }

        $f = new PhpExecutableFinder();

        $current = \PHP_BINARY;
        $args = 'phpdbg' === \PHP_SAPI ? ' -qrr' : '';

        $this->assertEquals($current.$args, $f->find(), '::find() returns the executable PHP');
        $this->assertEquals($current, $f->find(false), '::find() returns the executable PHP');
    }

    /**
     * tests find() with the env var / constant PHP_BINARY with HHVM.
     */
    public function testFindWithHHVM()
    {
        if (!\defined('HHVM_VERSION')) {
            $this->markTestSkipped('Should be executed in HHVM context.');
        }

        $f = new PhpExecutableFinder();

        $current = getenv('PHP_BINARY') ?: \PHP_BINARY;

        $this->assertEquals($current.' --php', $f->find(), '::find() returns the executable PHP');
        $this->assertEquals($current, $f->find(false), '::find() returns the executable PHP');
    }

    /**
     * tests find() with the env var PHP_PATH.
     */
    public function testFindArguments()
    {
        $f = new PhpExecutableFinder();

        if (\defined('HHVM_VERSION')) {
            $this->assertEquals(['--php'], $f->findArguments(), '::findArguments() returns HHVM arguments');
        } elseif ('phpdbg' === \PHP_SAPI) {
            $this->assertEquals(['-qrr'], $f->findArguments(), '::findArguments() returns phpdbg arguments');
        } else {
            $this->assertEquals([], $f->findArguments(), '::findArguments() returns no arguments');
        }
    }
}
