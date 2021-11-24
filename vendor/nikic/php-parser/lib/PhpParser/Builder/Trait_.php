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


namespace PhpParser\Builder;

use PhpParser;
use PhpParser\Node\Stmt;

class Trait_ extends Declaration
{
    protected $name;
    protected $uses = array();
    protected $properties = array();
    protected $methods = array();

    /**
     * Creates an interface builder.
     *
     * @param string $name Name of the interface
     */
    public function __construct($name) {
        $this->name = $name;
    }

    /**
     * Adds a statement.
     *
     * @param Stmt|PhpParser\Builder $stmt The statement to add
     *
     * @return $this The builder instance (for fluid interface)
     */
    public function addStmt($stmt) {
        $stmt = $this->normalizeNode($stmt);

        if ($stmt instanceof Stmt\Property) {
            $this->properties[] = $stmt;
        } else if ($stmt instanceof Stmt\ClassMethod) {
            $this->methods[] = $stmt;
        } else if ($stmt instanceof Stmt\TraitUse) {
            $this->uses[] = $stmt;
        } else {
            throw new \LogicException(sprintf('Unexpected node of type "%s"', $stmt->getType()));
        }

        return $this;
    }

    /**
     * Returns the built trait node.
     *
     * @return Stmt\Trait_ The built interface node
     */
    public function getNode() {
        return new Stmt\Trait_(
            $this->name, array(
                'stmts' => array_merge($this->uses, $this->properties, $this->methods)
            ), $this->attributes
        );
    }
}
