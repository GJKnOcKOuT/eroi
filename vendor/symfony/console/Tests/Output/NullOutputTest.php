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

namespace Symfony\Component\Console\Tests\Output;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Formatter\OutputFormatter;
use Symfony\Component\Console\Output\NullOutput;
use Symfony\Component\Console\Output\Output;
use Symfony\Component\Console\Output\OutputInterface;

class NullOutputTest extends TestCase
{
    public function testConstructor()
    {
        $output = new NullOutput();

        ob_start();
        $output->write('foo');
        $buffer = ob_get_clean();

        $this->assertSame('', $buffer, '->write() does nothing (at least nothing is printed)');
        $this->assertFalse($output->isDecorated(), '->isDecorated() returns false');
    }

    public function testVerbosity()
    {
        $output = new NullOutput();
        $this->assertSame(OutputInterface::VERBOSITY_QUIET, $output->getVerbosity(), '->getVerbosity() returns VERBOSITY_QUIET for NullOutput by default');

        $output->setVerbosity(OutputInterface::VERBOSITY_VERBOSE);
        $this->assertSame(OutputInterface::VERBOSITY_QUIET, $output->getVerbosity(), '->getVerbosity() always returns VERBOSITY_QUIET for NullOutput');
    }

    public function testSetFormatter()
    {
        $output = new NullOutput();
        $outputFormatter = new OutputFormatter();
        $output->setFormatter($outputFormatter);
        $this->assertNotSame($outputFormatter, $output->getFormatter());
    }

    public function testSetVerbosity()
    {
        $output = new NullOutput();
        $output->setVerbosity(Output::VERBOSITY_NORMAL);
        $this->assertEquals(Output::VERBOSITY_QUIET, $output->getVerbosity());
    }

    public function testSetDecorated()
    {
        $output = new NullOutput();
        $output->setDecorated(true);
        $this->assertFalse($output->isDecorated());
    }

    public function testIsQuiet()
    {
        $output = new NullOutput();
        $this->assertTrue($output->isQuiet());
    }

    public function testIsVerbose()
    {
        $output = new NullOutput();
        $this->assertFalse($output->isVerbose());
    }

    public function testIsVeryVerbose()
    {
        $output = new NullOutput();
        $this->assertFalse($output->isVeryVerbose());
    }

    public function testIsDebug()
    {
        $output = new NullOutput();
        $this->assertFalse($output->isDebug());
    }
}
