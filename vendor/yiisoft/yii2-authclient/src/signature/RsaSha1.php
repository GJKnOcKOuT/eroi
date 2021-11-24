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

/**
 * @deprecated
 *
 * RsaSha1 represents 'RSA-SHA1' signature method.
 *
 * Since 2.1.3 this class is deprecated, use [[RsaSha]] with `OPENSSL_ALGO_SHA1` algorithm instead.
 *
 * @see RsaSha
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
class RsaSha1 extends RsaSha
{
    /**
     * {@inheritdoc}
     */
    public $algorithm = OPENSSL_ALGO_SHA1;


    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'RSA-SHA1';
    }
}