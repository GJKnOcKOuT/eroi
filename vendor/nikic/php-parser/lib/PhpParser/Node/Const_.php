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


namespace PhpParser\Node;

use PhpParser\NodeAbstract;

class Const_ extends NodeAbstract
{
    /** @var string Name */
    public $name;
    /** @var Expr Value */
    public $value;

    /**
     * Constructs a const node for use in class const and const statements.
     *
     * @param string  $name       Name
     * @param Expr    $value      Value
     * @param array   $attributes Additional attributes
     */
    public function __construct($name, Expr $value, array $attributes = array()) {
        parent::__construct($attributes);
        $this->name = $name;
        $this->value = $value;
    }

    public function getSubNodeNames() {
        return array('name', 'value');
    }
}
