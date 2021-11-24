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

use Yii;
use yii\base\BaseObject;

/**
 * UrlEncodedFormatter formats HTTP message as 'application/x-www-form-urlencoded'.
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.0
 */
class UrlEncodedFormatter extends BaseObject implements FormatterInterface
{
    /**
     * @var int URL encoding type.
     * Possible values are:
     *  - PHP_QUERY_RFC1738 - encoding is performed per 'RFC 1738' and the 'application/x-www-form-urlencoded' media type,
     *    which implies that spaces are encoded as plus (+) signs. This is most common encoding type used by most web
     *    applications.
     *  - PHP_QUERY_RFC3986 - then encoding is performed according to 'RFC 3986', and spaces will be percent encoded (%20).
     *    This encoding type is required by OpenID and OAuth protocols.
     */
    public $encodingType = PHP_QUERY_RFC1738;
    /**
     * @var string the content charset. If not set, it will use the value of [[\yii\base\Application::charset]].
     * @since 2.0.1
     */
    public $charset;


    /**
     * {@inheritdoc}
     */
    public function format(Request $request)
    {
        if (($data = $request->getData()) !== null) {
            $content = http_build_query((array)$data, '', '&', $this->encodingType);
        }

        if (strcasecmp('GET', $request->getMethod()) === 0) {
            if (!empty($content)) {
                $request->setFullUrl(null);
                $url = $request->getFullUrl();
                $url .= (strpos($url, '?') === false) ? '?' : '&';
                $url .= $content;
                $request->setFullUrl($url);
            }
            return $request;
        }

        $charset = $this->charset === null ? Yii::$app->charset : $this->charset;
        $request->getHeaders()->set('Content-Type', 'application/x-www-form-urlencoded; charset=' . $charset);

        if (isset($content)) {
            $request->setContent($content);
        }

        if (!isset($content) && !isset($request->getOptions()[CURLOPT_INFILE])) {
            $request->getHeaders()->set('Content-Length', '0');
        }

        return $request;
    }
}