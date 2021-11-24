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

class NullableType extends NodeAbstract
{
    /** @var string|Name Type */
    public $type;

    /**
     * Constructs a nullable type (wrapping another type).
     *
     * @param string|Name $type       Type
     * @param array       $attributes Additional attributes
     */
    public function __construct($type, array $attributes = array()) {
        parent::__construct($attributes);
        $this->type = $type;
    }

    public function getSubNodeNames() {
        return array('type');
    }
}
