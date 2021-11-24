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

class List_ extends Expr
{
    /** @var ArrayItem[] List of items to assign to */
    public $items;

    /**
     * Constructs a list() destructuring node.
     *
     * @param ArrayItem[] $items      List of items to assign to
     * @param array       $attributes Additional attributes
     */
    public function __construct(array $items, array $attributes = array()) {
        parent::__construct($attributes);
        $this->items = $items;
    }

    public function getSubNodeNames() {
        return array('items');
    }
}
