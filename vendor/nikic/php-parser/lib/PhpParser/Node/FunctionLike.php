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

use PhpParser\Node;

interface FunctionLike extends Node
{
    /**
     * Whether to return by reference
     *
     * @return bool
     */
    public function returnsByRef();

    /**
     * List of parameters
     *
     * @return Node\Param[]
     */
    public function getParams();

    /**
     * Get the declared return type or null
     * 
     * @return null|string|Node\Name|Node\NullableType
     */
    public function getReturnType();

    /**
     * The function body
     *
     * @return Node\Stmt[]
     */
    public function getStmts();
}
