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

namespace hanneskod\classtools\Transformer\Action;

use PhpParser\NodeVisitorAbstract;
use PhpParser\Node\Stmt\Namespace_;
use PhpParser\Node\Name;

/**
 * Wrap code in namespace
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class NamespaceWrapper extends NodeVisitorAbstract
{
    /**
     * @var string Name of namespace
     */
    private $namespaceName;

    /**
     * Wrap code in namespace
     *
     * @param string $namespaceName Name of namespace
     */
    public function __construct($namespaceName)
    {
        $this->namespaceName = $namespaceName;
    }

    /**
     * {inheritdoc}
     *
     * @param  array $nodes
     * @return Namespace_[]
     */
    public function beforeTraverse(array $nodes)
    {
        // Merge if code is namespaced
        if (isset($nodes[0]) && $nodes[0] instanceof Namespace_) {
            if ($this->namespaceName) {
                if ((string)$nodes[0]->name == '') {
                    $nodes[0]->name = new Name($this->namespaceName);
                } else {
                    $nodes[0]->name = Name::concat($this->namespaceName, $nodes[0]->name);
                }
            }
            return $nodes;
        }

        // Else create new node
        return [
            new Namespace_(
                new Name($this->namespaceName),
                $nodes
            )
        ];
    }
}
