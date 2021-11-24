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
* 
* Provider writed by xbreaker | https://github.com/xbreaker/hybridauth
*/

/**
 * Hybrid_Providers_Yandex provider adapter based on OAuth2 protocol
 * 
 */
class Hybrid_Providers_Yandex extends Hybrid_Provider_Model_OAuth2
{ 
	/**
	* IDp wrappers initializer 
	*/
	function initialize() 
	{
		parent::initialize();

		// Provider apis end-points
		$this->api->api_base_url  = "https://login.yandex.ru/info";
		$this->api->authorize_url = "https://oauth.yandex.ru/authorize";
		$this->api->token_url     = "https://oauth.yandex.ru/token"; 

		$this->api->sign_token_name = "oauth_token";
		
	        // Override the redirect uri when it's set in the config parameters. This way we prevent
	        // redirect uri mismatches when authenticating. Just like Google provider does.
	        if (isset($this->config['redirect_uri']) && !empty($this->config['redirect_uri'])) {
            	$this->api->redirect_uri = $this->config['redirect_uri'];
        	}
	}

	/**
	* load the user profile from the IDp api client
	*/
	function getUserProfile()
	{
		$response = $this->api->api( "?format=json" ); 
		if ( ! isset( $response->id ) ){
			throw new Exception( "User profile request failed! {$this->providerId} returned an invalid response.", 6 );
		}
    
    $this->user->profile->identifier    = (property_exists($response,'id'))?$response->id:"";
		$this->user->profile->firstName     = (property_exists($response,'real_name'))?$response->real_name:"";
		$this->user->profile->lastName      = (property_exists($response,'family_name'))?$response->family_name:"";
		$this->user->profile->displayName   = (property_exists($response,'display_name'))?$response->display_name:"";
		$this->user->profile->photoURL      = 'http://upics.yandex.net/'. $this->user->profile->identifier .'/normal';
		$this->user->profile->profileURL    = "";
		$this->user->profile->gender        = (property_exists($response,'sex'))?$response->sex:""; 
		$this->user->profile->email         = (property_exists($response,'default_email'))?$response->default_email:"";
		$this->user->profile->emailVerified = (property_exists($response,'default_email'))?$response->default_email:"";

		if( property_exists($response,'birthday') && ! empty($response->birthday) ){ 
			list($birthday_year, $birthday_month, $birthday_day) = explode( '-', $response->birthday );

			$this->user->profile->birthDay   = (int) $birthday_day;
			$this->user->profile->birthMonth = (int) $birthday_month;
			$this->user->profile->birthYear  = (int) $birthday_year;
		}

		return $this->user->profile;
	}
}
