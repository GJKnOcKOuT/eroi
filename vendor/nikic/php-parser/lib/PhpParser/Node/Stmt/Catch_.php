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

class Catch_ extends Node\Stmt
{
    /** @var Node\Name[] Types of exceptions to catch */
    public $types;
    /** @var string Variable for exception */
    public $var;
    /** @var Node[] Statements */
    public $stmts;

    /**
     * Constructs a catch node.
     *
     * @param Node\Name[] $types      Types of exceptions to catch
     * @param string      $var        Variable for exception
     * @param Node[]      $stmts      Statements
     * @param array       $attributes Additional attributes
     */
    public function __construct(array $types, $var, array $stmts = array(), array $attributes = array()) {
        parent::__construct($attributes);
        $this->types = $types;
        $this->var = $var;
        $this->stmts = $stmts;
    }

    public function getSubNodeNames() {
        return array('types', 'var', 'stmts');
    }
}
