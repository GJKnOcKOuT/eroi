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

namespace yii\authclient\signature;

use yii\base\BaseObject;

/**
 * BaseMethod is a base class for the OAuth signature methods.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
abstract class BaseMethod extends BaseObject
{
    /**
     * Return the canonical name of the Signature Method.
     * @return string method name.
     */
    abstract public function getName();

    /**
     * Generates OAuth request signature.
     * @param string $baseString signature base string.
     * @param string $key signature key.
     * @return string signature string.
     */
    abstract public function generateSignature($baseString, $key);

    /**
     * Verifies given OAuth request.
     * @param string $signature signature to be verified.
     * @param string $baseString signature base string.
     * @param string $key signature key.
     * @return bool success.
     */
    public function verify($signature, $baseString, $key)
    {
        $expectedSignature = $this->generateSignature($baseString, $key);
        if (empty($signature) || empty($expectedSignature)) {
            return false;
        }

        return (strcmp($expectedSignature, $signature) === 0);
    }
}
