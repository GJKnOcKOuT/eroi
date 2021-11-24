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

namespace Symfony\Component\Finder\Tests\Iterator;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Finder\Iterator\MultiplePcreFilterIterator;

class MultiplePcreFilterIteratorTest extends TestCase
{
    /**
     * @dataProvider getIsRegexFixtures
     */
    public function testIsRegex($string, $isRegex, $message)
    {
        $testIterator = new TestMultiplePcreFilterIterator();
        $this->assertEquals($isRegex, $testIterator->isRegex($string), $message);
    }

    public function getIsRegexFixtures()
    {
        return [
            ['foo', false, 'string'],
            [' foo ', false, '" " is not a valid delimiter'],
            ['\\foo\\', false, '"\\" is not a valid delimiter'],
            ['afooa', false, '"a" is not a valid delimiter'],
            ['//', false, 'the pattern should contain at least 1 character'],
            ['/a/', true, 'valid regex'],
            ['/foo/', true, 'valid regex'],
            ['/foo/i', true, 'valid regex with a single modifier'],
            ['/foo/imsxu', true, 'valid regex with multiple modifiers'],
            ['#foo#', true, '"#" is a valid delimiter'],
            ['{foo}', true, '"{,}" is a valid delimiter pair'],
            ['[foo]', true, '"[,]" is a valid delimiter pair'],
            ['(foo)', true, '"(,)" is a valid delimiter pair'],
            ['<foo>', true, '"<,>" is a valid delimiter pair'],
            ['*foo.*', false, '"*" is not considered as a valid delimiter'],
            ['?foo.?', false, '"?" is not considered as a valid delimiter'],
        ];
    }
}

class TestMultiplePcreFilterIterator extends MultiplePcreFilterIterator
{
    public function __construct()
    {
    }

    public function accept()
    {
        throw new \BadFunctionCallException('Not implemented');
    }

    public function isRegex($str)
    {
        return parent::isRegex($str);
    }

    public function toRegex($str)
    {
        throw new \BadFunctionCallException('Not implemented');
    }
}
