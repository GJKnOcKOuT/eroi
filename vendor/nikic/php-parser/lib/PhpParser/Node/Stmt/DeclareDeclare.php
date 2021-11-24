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

class DeclareDeclare extends Node\Stmt
{
    /** @var string Key */
    public $key;
    /** @var Node\Expr Value */
    public $value;

    /**
     * Constructs a declare key=>value pair node.
     *
     * @param string    $key        Key
     * @param Node\Expr $value      Value
     * @param array     $attributes Additional attributes
     */
    public function __construct($key, Node\Expr $value, array $attributes = array()) {
        parent::__construct($attributes);
        $this->key = $key;
        $this->value = $value;
    }

    public function getSubNodeNames() {
        return array('key', 'value');
    }
}
