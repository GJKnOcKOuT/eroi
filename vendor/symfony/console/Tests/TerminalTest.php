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

namespace Symfony\Component\Console\Tests;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Terminal;

class TerminalTest extends TestCase
{
    private $colSize;
    private $lineSize;
    private $ansiCon;

    protected function setUp()
    {
        $this->colSize = getenv('COLUMNS');
        $this->lineSize = getenv('LINES');
        $this->ansiCon = getenv('ANSICON');
        $this->resetStatics();
    }

    protected function tearDown()
    {
        putenv($this->colSize ? 'COLUMNS='.$this->colSize : 'COLUMNS');
        putenv($this->lineSize ? 'LINES' : 'LINES='.$this->lineSize);
        putenv($this->ansiCon ? 'ANSICON='.$this->ansiCon : 'ANSICON');
        $this->resetStatics();
    }

    private function resetStatics()
    {
        foreach (['height', 'width', 'stty'] as $name) {
            $property = new \ReflectionProperty(Terminal::class, $name);
            $property->setAccessible(true);
            $property->setValue(null);
        }
    }

    public function test()
    {
        putenv('COLUMNS=100');
        putenv('LINES=50');
        $terminal = new Terminal();
        $this->assertSame(100, $terminal->getWidth());
        $this->assertSame(50, $terminal->getHeight());

        putenv('COLUMNS=120');
        putenv('LINES=60');
        $terminal = new Terminal();
        $this->assertSame(120, $terminal->getWidth());
        $this->assertSame(60, $terminal->getHeight());
    }

    public function testZeroValues()
    {
        putenv('COLUMNS=0');
        putenv('LINES=0');

        $terminal = new Terminal();

        $this->assertSame(0, $terminal->getWidth());
        $this->assertSame(0, $terminal->getHeight());
    }

    public function testSttyOnWindows()
    {
        if ('\\' !== \DIRECTORY_SEPARATOR) {
            $this->markTestSkipped('Must be on windows');
        }

        $sttyString = exec('(stty -a | grep columns) 2>&1', $output, $exitcode);
        if (0 !== $exitcode) {
            $this->markTestSkipped('Must have stty support');
        }

        $matches = [];
        if (0 === preg_match('/columns.(\d+)/i', $sttyString, $matches)) {
            $this->fail('Could not determine existing stty columns');
        }

        putenv('COLUMNS');
        putenv('LINES');
        putenv('ANSICON');

        $terminal = new Terminal();
        $this->assertSame((int) $matches[1], $terminal->getWidth());
    }
}
