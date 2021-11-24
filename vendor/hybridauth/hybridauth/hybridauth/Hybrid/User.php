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
 * HybridAuth
 * http://hybridauth.sourceforge.net | http://github.com/hybridauth/hybridauth
 * (c) 2009-2015, HybridAuth authors | http://hybridauth.sourceforge.net/licenses.html
 */

/**
 * The Hybrid_User class represents the current logged in user
 */
class Hybrid_User {

	/**
	 * The ID (name) of the connected provider
	 * @var mixed
	 */
	public $providerId = null;

	/**
	 * Timestamp connection to the provider
	 * @var int
	 */
	public $timestamp = null;

	/**
	 * User profile, contains the list of fields available in the normalized user profile structure used by HybridAuth
	 * @var Hybrid_User_Profile
	 */
	public $profile = null;

	/**
	 * Initialize the user object
	 */
	function __construct() {
		$this->timestamp = time();
		$this->profile = new Hybrid_User_Profile();
	}

}
