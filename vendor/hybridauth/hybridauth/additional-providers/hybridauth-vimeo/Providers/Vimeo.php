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


/* !
 * Hybridauth
 * https://hybridauth.github.io/hybridauth | https://github.com/hybridauth/hybridauth
 * (c) 2017 Hybridauth authors | https://hybridauth.github.io/license.html
 */

/**
 * Hybrid_Providers_Vimeo OAuth2 provider adapter.
 */
class Hybrid_Providers_Vimeo extends Hybrid_Provider_Model_OAuth2 {

    /**
     * {@inheritdoc}
     *
     * @see https://developer.vimeo.com/api/authentication
     */
    public $scope = "public";

    /**
     * {@inheritdoc}
     */
    function initialize() {
        parent::initialize();

        // Provider api end-points.
        $this->api->api_base_url = "https://api.vimeo.com/";
        $this->api->authorize_url = "https://api.vimeo.com/oauth/authorize";
        $this->api->token_url = "https://api.vimeo.com/oauth/access_token";
    }

    /**
     * {@inheritdoc}
     */
    function loginBegin() {
        if (is_array($this->scope)) {
            $this->scope = implode(" ", $this->scope);
        }
        parent::loginBegin();
    }

    /**
     * {@inheritdoc}
     *
     * @see https://developer.vimeo.com/api/endpoints/me
     */
    function getUserProfile() {
        // Refresh tokens if needed.
        $this->setHeaders("basic");
        $this->refreshToken();

        $this->setHeaders("bearer");
        $response = $this->api->get("me");

        if (!isset($response->uri)) {
            throw new Exception("User profile request failed! {$this->providerId} returned an invalid response: " . Hybrid_Logger::dumpData($response), 6);
        }

        $this->user->profile->identifier = isset($response->uri) ? ltrim($response->uri, "/users/") : "";
        $this->user->profile->photoURL = !empty($response->pictures) ? end($response->pictures->sizes)->link : "";
        $this->user->profile->profileURL = isset($response->link) ? $response->link : "";
        $this->user->profile->webSiteURL = !empty($response->websites) ? reset($response->websites)->link : "";
        $this->user->profile->description = isset($response->bio) ? $response->bio : "";
        $this->user->profile->address = isset($response->location) ? $response->location : "";
        $this->user->profile->displayName = isset($response->name) ? $response->name : "";

        return $this->user->profile;
    }

    /**
     * Set correct Authorization headers.
     *
     * @param string $token_type
     *   Specify token type.
     *
     * @return void
     */
    protected function setHeaders($token_type = null) {
        switch ($token_type) {
            case "basic":
                $token = base64_encode("{$this->config["keys"]["id"]}:{$this->config["keys"]["secret"]}");
                $this->api->curl_header = array(
                    "Authorization: Basic {$token}",
                );
                break;

            case "bearer":
                $this->api->curl_header = array(
                    "Authorization: Bearer {$this->api->access_token}",
                );
                break;
        }
    }

}
