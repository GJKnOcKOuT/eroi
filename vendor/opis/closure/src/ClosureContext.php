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

/* ===========================================================================
 * Copyright (c) 2018-2021 Zindex Software
 *
 * Licensed under the MIT License
 * =========================================================================== */

namespace Opis\Closure;

/**
 * Closure context class
 * @internal
 */
class ClosureContext
{
    /**
     * @var ClosureScope Closures scope
     */
    public $scope;

    /**
     * @var integer
     */
    public $locks;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->scope = new ClosureScope();
        $this->locks = 0;
    }
}