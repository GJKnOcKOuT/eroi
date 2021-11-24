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
use PhpParser\Node\FunctionLike;

class ClassMethod extends Node\Stmt implements FunctionLike
{
    /** @var int Flags */
    public $flags;
    /** @var bool Whether to return by reference */
    public $byRef;
    /** @var string Name */
    public $name;
    /** @var Node\Param[] Parameters */
    public $params;
    /** @var null|string|Node\Name|Node\NullableType Return type */
    public $returnType;
    /** @var Node[]|null Statements */
    public $stmts;

    /** @deprecated Use $flags instead */
    public $type;

    /**
     * Constructs a class method node.
     *
     * @param string      $name       Name
     * @param array       $subNodes   Array of the following optional subnodes:
     *                                'flags       => MODIFIER_PUBLIC: Flags
     *                                'byRef'      => false          : Whether to return by reference
     *                                'params'     => array()        : Parameters
     *                                'returnType' => null           : Return type
     *                                'stmts'      => array()        : Statements
     * @param array       $attributes Additional attributes
     */
    public function __construct($name, array $subNodes = array(), array $attributes = array()) {
        parent::__construct($attributes);
        $this->flags = isset($subNodes['flags']) ? $subNodes['flags']
            : (isset($subNodes['type']) ? $subNodes['type'] : 0);
        $this->type = $this->flags;
        $this->byRef = isset($subNodes['byRef'])  ? $subNodes['byRef']  : false;
        $this->name = $name;
        $this->params = isset($subNodes['params']) ? $subNodes['params'] : array();
        $this->returnType = isset($subNodes['returnType']) ? $subNodes['returnType'] : null;
        $this->stmts = array_key_exists('stmts', $subNodes) ? $subNodes['stmts'] : array();
    }

    public function getSubNodeNames() {
        return array('flags', 'byRef', 'name', 'params', 'returnType', 'stmts');
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

    public function isPublic() {
        return ($this->flags & Class_::MODIFIER_PUBLIC) !== 0
            || ($this->flags & Class_::VISIBILITY_MODIFIER_MASK) === 0;
    }

    public function isProtected() {
        return (bool) ($this->flags & Class_::MODIFIER_PROTECTED);
    }

    public function isPrivate() {
        return (bool) ($this->flags & Class_::MODIFIER_PRIVATE);
    }

    public function isAbstract() {
        return (bool) ($this->flags & Class_::MODIFIER_ABSTRACT);
    }

    public function isFinal() {
        return (bool) ($this->flags & Class_::MODIFIER_FINAL);
    }

    public function isStatic() {
        return (bool) ($this->flags & Class_::MODIFIER_STATIC);
    }
}
