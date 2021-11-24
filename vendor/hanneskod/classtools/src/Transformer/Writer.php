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

/**
 * This program is free software. It comes without any warranty, to
 * the extent permitted by applicable law. You can redistribute it
 * and/or modify it under the terms of the Do What The Fuck You Want
 * To Public License, Version 2, as published by Sam Hocevar. See
 * http://www.wtfpl.net/ for more details.
 */

namespace hanneskod\classtools\Transformer;

use PhpParser\NodeTraverser;
use PhpParser\NodeVisitor;
use PhpParser\Error as PhpParserException;
use hanneskod\classtools\Exception\RuntimeException;

/**
 * Translate and print parsed code snippets
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class Writer
{
    /**
     * @var NodeTraverser Traverser used for altering parsed code
     */
    private $traverser;

    /**
     * @var BracketingPrinter Printer used for printing traversed code
     */
    private $printer;

    /**
     * Optionally inject dependencies
     *
     * Since Reader always makes definitions namespaced a PhpParser printer that
     * wraps the code in brackeded namespace statements must be used. The current
     * implementation of this is BracketingPrinter.
     *
     * @param NodeTraverser     $traverser
     * @param BracketingPrinter $printer
     */
    public function __construct(NodeTraverser $traverser = null, BracketingPrinter $printer = null)
    {
        $this->traverser = $traverser ?: new NodeTraverser;
        $this->printer = $printer ?: new BracketingPrinter;
    }

    /**
     * Apply translation to alter code
     *
     * @param  NodeVisitor $translation
     * @return Writer      Instance for chaining
     */
    public function apply(NodeVisitor $translation)
    {
        $this->traverser->addVisitor($translation);
        return $this;
    }

    /**
     * Generate new code snippet
     *
     * @param  array $statements
     * @return string
     * @throws RuntimeException If code generation failes
     */
    public function write(array $statements)
    {
        try {
            return $this->printer->prettyPrint(
                $this->traverser->traverse(
                    $statements
                )
            );
        } catch (PhpParserException $e) {
            throw new RuntimeException("Error generating code: {$e->getMessage()}", 0, $e);
        }
    }
}
