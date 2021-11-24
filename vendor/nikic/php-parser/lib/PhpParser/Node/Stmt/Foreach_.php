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


namespace PhpParser\Node\Stmt;

use PhpParser\Node;

class Foreach_ extends Node\Stmt
{
    /** @var Node\Expr Expression to iterate */
    public $expr;
    /** @var null|Node\Expr Variable to assign key to */
    public $keyVar;
    /** @var bool Whether to assign value by reference */
    public $byRef;
    /** @var Node\Expr Variable to assign value to */
    public $valueVar;
    /** @var Node[] Statements */
    public $stmts;

    /**
     * Constructs a foreach node.
     *
     * @param Node\Expr $expr       Expression to iterate
     * @param Node\Expr $valueVar   Variable to assign value to
     * @param array     $subNodes   Array of the following optional subnodes:
     *                              'keyVar' => null   : Variable to assign key to
     *                              'byRef'  => false  : Whether to assign value by reference
     *                              'stmts'  => array(): Statements
     * @param array     $attributes Additional attributes
     */
    public function __construct(Node\Expr $expr, Node\Expr $valueVar, array $subNodes = array(), array $attributes = array()) {
        parent::__construct($attributes);
        $this->expr = $expr;
        $this->keyVar = isset($subNodes['keyVar']) ? $subNodes['keyVar'] : null;
        $this->byRef = isset($subNodes['byRef']) ? $subNodes['byRef'] : false;
        $this->valueVar = $valueVar;
        $this->stmts = isset($subNodes['stmts']) ? $subNodes['stmts'] : array();
    }

    public function getSubNodeNames() {
        return array('expr', 'keyVar', 'byRef', 'valueVar', 'stmts');
    }
}
