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

namespace yii\authclient\clients;

use yii\authclient\OAuth2;

/**
 * TwitterOAuth2 allows authentication via Twitter OAuth 2.
 *
 * Note, that at the time these docs are written, Twitter does not provide full support for OAuth 2 protocol.
 * It is supported only for [application-only authentication](https://dev.twitter.com/oauth/application-only) workflow.
 * Thus only [[authenticateClient()]] method of this class has a practical usage.
 *
 * Any authentication attempt on behalf of the end-user will fail for this client. You should use [[Twitter]] class for
 * this workflow.
 *
 * @see Twitter
 * @see https://dev.twitter.com/
 *
 * @author Paul Klimov <klimov.paul@gmail.com>
 * @since 2.1.4
 */
class TwitterOAuth2 extends OAuth2
{
    /**
     * {@inheritdoc}
     */
    public $authUrl = 'https://api.twitter.com/oauth2/authenticate';
    /**
     * {@inheritdoc}
     */
    public $tokenUrl = 'https://api.twitter.com/oauth2/token';
    /**
     * {@inheritdoc}
     */
    public $apiBaseUrl = 'https://api.twitter.com/1.1';


    /**
     * {@inheritdoc}
     */
    protected function initUserAttributes()
    {
        return $this->api('account/verify_credentials.json', 'GET');
    }

    /**
     * {@inheritdoc}
     */
    protected function defaultName()
    {
        return 'twitter';
    }

    /**
     * {@inheritdoc}
     */
    protected function defaultTitle()
    {
        return 'Twitter';
    }

    /**
     * {@inheritdoc}
     */
    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $request->getHeaders()->set('Authorization', 'Bearer '. $accessToken->getToken());
    }
}