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

namespace Symfony\Component\CssSelector\Tests\Parser\Handler;

use Symfony\Component\CssSelector\Parser\Handler\NumberHandler;
use Symfony\Component\CssSelector\Parser\Token;
use Symfony\Component\CssSelector\Parser\Tokenizer\TokenizerPatterns;

class NumberHandlerTest extends AbstractHandlerTest
{
    public function getHandleValueTestData()
    {
        return array(
            array('12', new Token(Token::TYPE_NUMBER, '12', 0), ''),
            array('12.34', new Token(Token::TYPE_NUMBER, '12.34', 0), ''),
            array('+12.34', new Token(Token::TYPE_NUMBER, '+12.34', 0), ''),
            array('-12.34', new Token(Token::TYPE_NUMBER, '-12.34', 0), ''),

            array('12 arg', new Token(Token::TYPE_NUMBER, '12', 0), ' arg'),
            array('12]', new Token(Token::TYPE_NUMBER, '12', 0), ']'),
        );
    }

    public function getDontHandleValueTestData()
    {
        return array(
            array('hello'),
            array('>'),
            array('+'),
            array(' '),
            array('/* comment */'),
        );
    }

    protected function generateHandler()
    {
        $patterns = new TokenizerPatterns();

        return new NumberHandler($patterns);
    }
}
