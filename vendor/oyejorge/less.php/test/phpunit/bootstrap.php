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



class phpunit_bootstrap extends PHPUnit_Framework_TestCase{

	public $fixtures_dir;
	public $cache_dir;

	function setUp(){
		echo "\nSet-Up: ".get_class($this);

		$root_directory = dirname(dirname(dirname(__FILE__)));

		require_once( $root_directory . '/lib/Less/Autoloader.php' );
		Less_Autoloader::register();

		$this->fixtures_dir = $root_directory.'/test/Fixtures';
		echo "\n  fixtures_dir: ".$this->fixtures_dir;

		$this->cache_dir = $root_directory.'/test/phpunit/_cache/';
		$this->CheckCacheDirectory();


		echo "\n\n";
	}

	/**
	 * Return the path of the cache directory if it's writable
	 *
	 */
	function CheckCacheDirectory(){

		if( !file_exists($this->cache_dir) && !mkdir($this->cache_dir) ){
			echo "\n  cache_dir could not be created:    ".$this->cache_dir;
			return false;
		}

		if( !is_writable($this->cache_dir) ){
			echo "\n  cache_dir not writable:    ".$this->cache_dir;
			return false;
		}

		echo "\n  cache_dir:    ".$this->cache_dir;
	}

}