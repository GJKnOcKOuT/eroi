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


/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher\Debug;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @method reset() Resets the trace.
 */
interface TraceableEventDispatcherInterface extends EventDispatcherInterface
{
    /**
     * Gets the called listeners.
     *
     * @return array An array of called listeners
     */
    public function getCalledListeners();

    /**
     * Gets the not called listeners.
     *
     * @return array An array of not called listeners
     */
    public function getNotCalledListeners();
}
