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


namespace PhpParser\Node\Stmt\TraitUseAdaptation;

use PhpParser\Node;

class Precedence extends Node\Stmt\TraitUseAdaptation
{
    /** @var Node\Name[] Overwritten traits */
    public $insteadof;

    /**
     * Constructs a trait use precedence adaptation node.
     *
     * @param Node\Name   $trait       Trait name
     * @param string      $method      Method name
     * @param Node\Name[] $insteadof   Overwritten traits
     * @param array       $attributes  Additional attributes
     */
    public function __construct(Node\Name $trait, $method, array $insteadof, array $attributes = array()) {
        parent::__construct($attributes);
        $this->trait = $trait;
        $this->method = $method;
        $this->insteadof = $insteadof;
    }

    public function getSubNodeNames() {
        return array('trait', 'method', 'insteadof');
    }
}
