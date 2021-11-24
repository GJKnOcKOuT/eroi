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

final class MockTransport extends Transport
{
    /**
     * @var Request[]
     */
    private $requests = [];
    /**
     * @var Response[]
     */
    private $responses = [];


    /**
     * @param Response $response
     */
    public function appendResponse(Response $response)
    {
        $this->responses[] = $response;
    }

    /**
     * @return Request[]
     */
    public function flushRequests()
    {
        $requests = $this->requests;
        $this->requests = [];

        return $requests;
    }

    /**
     * {@inheritdoc}
     */
    public function send($request)
    {
        if (empty($this->responses)) {
            throw new Exception('No Response available');
        }

        $nextResponse = array_shift($this->responses);
        if (null === $nextResponse->client) {
            $nextResponse->client = $request->client;
        }

        $this->requests[] = $request;

        return $nextResponse;
    }
}
