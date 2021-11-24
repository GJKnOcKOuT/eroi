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

namespace yii\httpclient;

use yii\base\BaseObject;
use yii\helpers\Json;

/**
 * JsonFormatter formats HTTP message as JSON.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
class JsonFormatter extends BaseObject implements FormatterInterface
{
    /**
     * @var int the encoding options. For more details please refer to
     * <http://www.php.net/manual/en/function.json-encode.php>.
     */
    public $encodeOptions = 0;


    /**
     * {@inheritdoc}
     */
    public function format(Request $request)
    {
        $request->getHeaders()->set('Content-Type', 'application/json; charset=UTF-8');
        if (($data = $request->getData()) !== null) {
            $request->setContent(Json::encode($request->getData(), $this->encodeOptions));
        }
        return $request;
    }
}