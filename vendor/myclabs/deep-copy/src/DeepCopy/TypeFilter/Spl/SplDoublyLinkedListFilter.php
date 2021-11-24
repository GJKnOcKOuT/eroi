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


namespace DeepCopy\TypeFilter\Spl;

use Closure;
use DeepCopy\DeepCopy;
use DeepCopy\TypeFilter\TypeFilter;
use SplDoublyLinkedList;

/**
 * @final
 */
class SplDoublyLinkedListFilter implements TypeFilter
{
    private $copier;

    public function __construct(DeepCopy $copier)
    {
        $this->copier = $copier;
    }

    /**
     * {@inheritdoc}
     */
    public function apply($element)
    {
        $newElement = clone $element;

        $copy = $this->createCopyClosure();

        return $copy($newElement);
    }

    private function createCopyClosure()
    {
        $copier = $this->copier;

        $copy = function (SplDoublyLinkedList $list) use ($copier) {
            // Replace each element in the list with a deep copy of itself
            for ($i = 1; $i <= $list->count(); $i++) {
                $copy = $copier->recursiveCopy($list->shift());

                $list->push($copy);
            }

            return $list;
        };

        return Closure::bind($copy, null, DeepCopy::class);
    }
}
