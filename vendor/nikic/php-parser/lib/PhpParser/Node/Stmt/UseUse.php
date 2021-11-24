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

class UseUse extends Node\Stmt
{
    /** @var int One of the Stmt\Use_::TYPE_* constants. Will only differ from TYPE_UNKNOWN for mixed group uses */
    public $type;
    /** @var Node\Name Namespace, class, function or constant to alias */
    public $name;
    /** @var string Alias */
    public $alias;

    /**
     * Constructs an alias (use) node.
     *
     * @param Node\Name   $name       Namespace/Class to alias
     * @param null|string $alias      Alias
     * @param int         $type       Type of the use element (for mixed group use declarations only)
     * @param array       $attributes Additional attributes
     */
    public function __construct(Node\Name $name, $alias = null, $type = Use_::TYPE_UNKNOWN, array $attributes = array()) {
        if (null === $alias) {
            $alias = $name->getLast();
        }

        parent::__construct($attributes);
        $this->type = $type;
        $this->name = $name;
        $this->alias = $alias;
    }

    public function getSubNodeNames() {
        return array('type', 'name', 'alias');
    }
}
