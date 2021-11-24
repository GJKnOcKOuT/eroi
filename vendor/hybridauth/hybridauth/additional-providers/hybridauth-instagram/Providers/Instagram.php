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

/*!
* HybridAuth
* http://hybridauth.sourceforge.net | https://github.com/hybridauth/hybridauth
*  (c) 2009-2012 HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
*/

/**
 * Class Hybrid_Providers_Instagram.
 */
class Hybrid_Providers_Instagram extends Hybrid_Provider_Model_OAuth2 {

  /**
   * {@inheritdoc}
   */
  public $scope = "user_profile,user_media";

  /**
   * {@inheritdoc}
   */
  public function initialize() {
    parent::initialize();

    // Provider api end-points.
    $this->api->api_base_url = "https://graph.instagram.com/";
    $this->api->authorize_url = "https://api.instagram.com/oauth/authorize";
    $this->api->token_url = "https://api.instagram.com/oauth/access_token";
  }

  /**
   * {@inheritdoc}
   */
  public function getUserProfile() {
    $data = $this->api->api("me", "GET", [
      'fields' => 'id,username,media_count',
    ]);

    if (empty($data->id)) {
      throw new Exception("User profile request failed! {$this->providerId} returned an invalid response.", 6);
    }

    $this->user->profile->identifier = $data->id;
    $this->user->profile->displayName = $data->username;
    $this->user->profile->profileURL = "https://instagram.com/{$data->username}";

    return $this->user->profile;
  }

}
