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

namespace Symfony\Component\CssSelector\Parser\Tokenizer;

use Symfony\Component\CssSelector\Parser\Handler;
use Symfony\Component\CssSelector\Parser\Reader;
use Symfony\Component\CssSelector\Parser\Token;
use Symfony\Component\CssSelector\Parser\TokenStream;

/**
 * CSS selector tokenizer.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class Tokenizer
{
    /**
     * @var Handler\HandlerInterface[]
     */
    private $handlers;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $patterns = new TokenizerPatterns();
        $escaping = new TokenizerEscaping($patterns);

        $this->handlers = array(
            new Handler\WhitespaceHandler(),
            new Handler\IdentifierHandler($patterns, $escaping),
            new Handler\HashHandler($patterns, $escaping),
            new Handler\StringHandler($patterns, $escaping),
            new Handler\NumberHandler($patterns),
            new Handler\CommentHandler(),
        );
    }

    /**
     * Tokenize selector source code.
     *
     * @param Reader $reader
     *
     * @return TokenStream
     */
    public function tokenize(Reader $reader)
    {
        $stream = new TokenStream();

        while (!$reader->isEOF()) {
            foreach ($this->handlers as $handler) {
                if ($handler->handle($reader, $stream)) {
                    continue 2;
                }
            }

            $stream->push(new Token(Token::TYPE_DELIMITER, $reader->getSubstring(1), $reader->getPosition()));
            $reader->moveForward(1);
        }

        return $stream
            ->push(new Token(Token::TYPE_FILE_END, null, $reader->getPosition()))
            ->freeze();
    }
}
