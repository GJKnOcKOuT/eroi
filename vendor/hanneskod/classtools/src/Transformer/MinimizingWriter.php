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
use hanneskod\classtools\Transformer\Action\CommentStripper;
use hanneskod\classtools\Transformer\Action\NodeStripper;
use hanneskod\classtools\Transformer\Action\NameResolver;

/**
 * Minimize parsed code snippets
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class MinimizingWriter extends Writer
{
    /**
     * Load minimizing translations at construct
     *
     * @param NodeTraverser $traverser
     */
    public function __construct(NodeTraverser $traverser = null)
    {
        parent::__construct($traverser);
        $this->apply(new CommentStripper);
        $this->apply(new NameResolver);
        $this->apply(new NodeStripper('Stmt_Use'));
    }
}
