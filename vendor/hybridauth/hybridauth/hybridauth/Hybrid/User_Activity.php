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
 * Hybrid_User_Activity
 *
 * used to provider the connected user activity stream on a standardized structure across supported social apis.
 *
 * http://hybridauth.sourceforge.net/userguide/Profile_Data_User_Activity.html
 */
class Hybrid_User_Activity {

	/**
	 * Activity id on the provider side, usually given as integer
	 * @var mixed
	 */
	public $id = null;

	/**
	 * Activity date of creation
	 * @var int
	 */
	public $date = null;

	/**
	 * Activity content as a string
	 * @var string
	 */
	public $text = null;

	/**
	 * User who created the activity
	 * @var stdClass
	 */
	public $user = null;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->user = new stdClass();

		// typically, we should have a few information about the user who created the event from social apis
		$this->user->identifier = null;
		$this->user->displayName = null;
		$this->user->profileURL = null;
		$this->user->photoURL = null;
	}

}
