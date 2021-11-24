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

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace yii\authclient;

/**
 * StateStorageInterface is an interface for Auth client state storage.
 *
 * Herein 'state' means a named variable, which is persistent between different requests.
 *
 * Note: in order to function correctly state storage should vary depending on application session,
 * e.g. different web users should not share state with the same name.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.1
 */
interface StateStorageInterface
{
    /**
     * Adds a state variable.
     * If the specified name already exists, the old value will be overwritten.
     * @param string $key variable name
     * @param mixed $value variable value
     */
    public function set($key, $value);

    /**
     * Returns the state variable value with the variable name.
     * @param string $key the variable name
     * @return mixed the variable value, or `null` if the variable does not exist.
     */
    public function get($key);

    /**
     * Removes a state variable.
     * @param string $key the name of the variable to be removed
     * @return bool success.
     */
    public function remove($key);
}
