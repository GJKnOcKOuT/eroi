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

use PhpParser\Node;
use PhpParser\Node\Expr;
use PhpParser\Node\FunctionLike;

class Closure extends Expr implements FunctionLike
{
    /** @var bool Whether the closure is static */
    public $static;
    /** @var bool Whether to return by reference */
    public $byRef;
    /** @var Node\Param[] Parameters */
    public $params;
    /** @var ClosureUse[] use()s */
    public $uses;
    /** @var null|string|Node\Name|Node\NullableType Return type */
    public $returnType;
    /** @var Node[] Statements */
    public $stmts;

    /**
     * Constructs a lambda function node.
     *
     * @param array $subNodes   Array of the following optional subnodes:
     *                          'static'     => false  : Whether the closure is static
     *                          'byRef'      => false  : Whether to return by reference
     *                          'params'     => array(): Parameters
     *                          'uses'       => array(): use()s
     *                          'returnType' => null   : Return type
     *                          'stmts'      => array(): Statements
     * @param array $attributes Additional attributes
     */
    public function __construct(array $subNodes = array(), array $attributes = array()) {
        parent::__construct($attributes);
        $this->static = isset($subNodes['static']) ? $subNodes['static'] : false;
        $this->byRef = isset($subNodes['byRef']) ? $subNodes['byRef'] : false;
        $this->params = isset($subNodes['params']) ? $subNodes['params'] : array();
        $this->uses = isset($subNodes['uses']) ? $subNodes['uses'] : array();
        $this->returnType = isset($subNodes['returnType']) ? $subNodes['returnType'] : null;
        $this->stmts = isset($subNodes['stmts']) ? $subNodes['stmts'] : array();
    }

    public function getSubNodeNames() {
        return array('static', 'byRef', 'params', 'uses', 'returnType', 'stmts');
    }

    public function returnsByRef() {
        return $this->byRef;
    }

    public function getParams() {
        return $this->params;
    }

    public function getReturnType() {
        return $this->returnType;
    }

    public function getStmts() {
        return $this->stmts;
    }
}
