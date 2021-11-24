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
use Symfony\Component\Process\ProcessUtils;

/**
 * @group legacy
 */
class ProcessUtilsTest extends TestCase
{
    /**
     * @dataProvider dataArguments
     */
    public function testEscapeArgument($result, $argument)
    {
        $this->assertSame($result, ProcessUtils::escapeArgument($argument));
    }

    public function dataArguments()
    {
        if ('\\' === \DIRECTORY_SEPARATOR) {
            return [
                ['"\"php\" \"-v\""', '"php" "-v"'],
                ['"foo bar"', 'foo bar'],
                ['^%"path"^%', '%path%'],
                ['"<|>\\" \\"\'f"', '<|>" "\'f'],
                ['""', ''],
                ['"with\trailingbs\\\\"', 'with\trailingbs\\'],
            ];
        }

        return [
            ["'\"php\" \"-v\"'", '"php" "-v"'],
            ["'foo bar'", 'foo bar'],
            ["'%path%'", '%path%'],
            ["'<|>\" \"'\\''f'", '<|>" "\'f'],
            ["''", ''],
            ["'with\\trailingbs\\'", 'with\trailingbs\\'],
            ["'withNonAsciiAccentLikeéÉèÈàÀöä'", 'withNonAsciiAccentLikeéÉèÈàÀöä'],
        ];
    }
}
