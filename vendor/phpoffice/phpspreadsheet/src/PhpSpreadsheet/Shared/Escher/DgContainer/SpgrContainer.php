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


namespace PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer;

class SpgrContainer
{
    /**
     * Parent Shape Group Container.
     *
     * @var \PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer
     */
    private $parent;

    /**
     * Shape Container collection.
     *
     * @var array
     */
    private $children = [];

    /**
     * Set parent Shape Group Container.
     *
     * @param \PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer $parent
     */
    public function setParent($parent)
    {
        $this->parent = $parent;
    }

    /**
     * Get the parent Shape Group Container if any.
     *
     * @return null|\PhpOffice\PhpSpreadsheet\Shared\Escher\DgContainer\SpgrContainer
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add a child. This will be either spgrContainer or spContainer.
     *
     * @param mixed $child
     */
    public function addChild($child)
    {
        $this->children[] = $child;
        $child->setParent($this);
    }

    /**
     * Get collection of Shape Containers.
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Recursively get all spContainers within this spgrContainer.
     *
     * @return SpgrContainer\SpContainer[]
     */
    public function getAllSpContainers()
    {
        $allSpContainers = [];

        foreach ($this->children as $child) {
            if ($child instanceof self) {
                $allSpContainers = array_merge($allSpContainers, $child->getAllSpContainers());
            } else {
                $allSpContainers[] = $child;
            }
        }

        return $allSpContainers;
    }
}
