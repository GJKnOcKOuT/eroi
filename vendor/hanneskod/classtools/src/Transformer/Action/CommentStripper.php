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
use PhpParser\Node;

/**
 * Strip comments
 *
 * @author Hannes Forsgård <hannes.forsgard@fripost.org>
 */
class CommentStripper extends NodeVisitorAbstract
{
    /**
     * Perform action
     *
     * @param  Node      $node
     * @return void|bool Void if node should remain, false if not
     */
    public function leaveNode(Node $node)
    {
        $node->setAttribute('comments', []);
    }
}
