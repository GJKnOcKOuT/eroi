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


namespace PhpParser\Node\Expr;

use PhpParser\Node\Expr;

abstract class BinaryOp extends Expr
{
    /** @var Expr The left hand side expression */
    public $left;
    /** @var Expr The right hand side expression */
    public $right;

    /**
     * Constructs a bitwise and node.
     *
     * @param Expr  $left       The left hand side expression
     * @param Expr  $right      The right hand side expression
     * @param array $attributes Additional attributes
     */
    public function __construct(Expr $left, Expr $right, array $attributes = array()) {
        parent::__construct($attributes);
        $this->left = $left;
        $this->right = $right;
    }

    public function getSubNodeNames() {
        return array('left', 'right');
    }
}
