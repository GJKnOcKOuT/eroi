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

use PhpParser\Node\Arg;
use PhpParser\Node\Expr;

class MethodCall extends Expr
{
    /** @var Expr Variable holding object */
    public $var;
    /** @var string|Expr Method name */
    public $name;
    /** @var Arg[] Arguments */
    public $args;

    /**
     * Constructs a function call node.
     *
     * @param Expr        $var        Variable holding object
     * @param string|Expr $name       Method name
     * @param Arg[]       $args       Arguments
     * @param array       $attributes Additional attributes
     */
    public function __construct(Expr $var, $name, array $args = array(), array $attributes = array()) {
        parent::__construct($attributes);
        $this->var = $var;
        $this->name = $name;
        $this->args = $args;
    }

    public function getSubNodeNames() {
        return array('var', 'name', 'args');
    }
}
