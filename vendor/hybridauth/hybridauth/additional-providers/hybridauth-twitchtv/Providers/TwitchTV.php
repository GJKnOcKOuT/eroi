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
* http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
* (c) 2009-2012, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html 
*/

/**
 * Hybrid_Providers_TwitchTV provider adapter based on OAuth2 protocol
 * 
 * http://hybridauth.sourceforge.net/userguide/IDProvider_info_TwitchTV.html
 */
class Hybrid_Providers_TwitchTV extends Hybrid_Provider_Model_OAuth2
{ 
	// default permissions 
	public $scope = "user_read channel_read";

	/**
	* IDp wrappers initializer 
	*/
	function initialize() 
	{
		parent::initialize();

		// Provider apis end-points
		$this->api->api_base_url    = "https://api.twitch.tv/kraken/";
		$this->api->authorize_url   = "https://api.twitch.tv/kraken/oauth2/authorize";
		$this->api->token_url       = "https://api.twitch.tv/kraken/oauth2/token"; 

		$this->api->sign_token_name = "oauth_token";
	}

	/**
	* begin login step 
	*/
	function loginBegin()
	{
		$parameters = array( "scope" => $this->scope );
		$optionals  = array( "scope" );

		foreach ($optionals as $parameter){
			if( isset( $this->config[$parameter] ) && ! empty( $this->config[$parameter] ) ){
				$parameters[$parameter] = $this->config[$parameter];
			}
		}

		Hybrid_Auth::redirect( $this->api->authorizeUrl( $parameters ) ); 
	}

	/**
	* load the user profile from the IDp api client
	*/
	function getUserProfile()
	{
		$data = $this->api->api( "user" ); 

		if ( ! isset( $data->name ) ){
			throw new Exception( "User profile request failed! {$this->providerId} returned an invalid response.", 6 );
		}

		$this->user->profile->identifier    = $data->_id; 
		$this->user->profile->displayName   = $data->display_name; 
		$this->user->profile->photoURL      = $data->logo; 
		$this->user->profile->profileURL    = "http://www.twitch.tv/" . $data->name; 
		$this->user->profile->email         = $data->email; 

		if( ! $this->user->profile->displayName ){ 
			$this->user->profile->displayName = $data->name; 
		}

		return $this->user->profile;
	}
}
