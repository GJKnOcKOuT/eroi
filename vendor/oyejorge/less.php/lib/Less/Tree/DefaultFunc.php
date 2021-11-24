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
 * DefaultFunc
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_DefaultFunc{

	static $error_;
	static $value_;

    public static function compile(){
		if( self::$error_ ){
			throw new Exception(self::$error_);
		}
		if( self::$value_ !== null ){
			return self::$value_ ? new Less_Tree_Keyword('true') : new Less_Tree_Keyword('false');
		}
	}

    public static function value( $v ){
		self::$value_ = $v;
	}

    public static function error( $e ){
		self::$error_ = $e;
	}

    public static function reset(){
		self::$value_ = self::$error_ = null;
	}
}