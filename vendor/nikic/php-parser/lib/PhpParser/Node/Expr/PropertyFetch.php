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

class PropertyFetch extends Expr
{
    /** @var Expr Variable holding object */
    public $var;
    /** @var string|Expr Property name */
    public $name;

    /**
     * Constructs a function call node.
     *
     * @param Expr        $var        Variable holding object
     * @param string|Expr $name       Property name
     * @param array       $attributes Additional attributes
     */
    public function __construct(Expr $var, $name, array $attributes = array()) {
        parent::__construct($attributes);
        $this->var = $var;
        $this->name = $name;
    }

    public function getSubNodeNames() {
        return array('var', 'name');
    }
}
