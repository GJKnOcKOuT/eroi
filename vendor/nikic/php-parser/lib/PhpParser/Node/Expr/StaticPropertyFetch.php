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
use PhpParser\Node\Name;

class StaticPropertyFetch extends Expr
{
    /** @var Name|Expr Class name */
    public $class;
    /** @var string|Expr Property name */
    public $name;

    /**
     * Constructs a static property fetch node.
     *
     * @param Name|Expr   $class      Class name
     * @param string|Expr $name       Property name
     * @param array       $attributes Additional attributes
     */
    public function __construct($class, $name, array $attributes = array()) {
        parent::__construct($attributes);
        $this->class = $class;
        $this->name = $name;
    }

    public function getSubNodeNames() {
        return array('class', 'name');
    }
}
