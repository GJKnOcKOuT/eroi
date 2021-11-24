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
 * Javascript
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_Javascript extends Less_Tree{

	public $type = 'Javascript';
	public $escaped;
	public $expression;
	public $index;

	/**
	 * @param boolean $index
	 * @param boolean $escaped
	 */
	public function __construct($string, $index, $escaped){
		$this->escaped = $escaped;
		$this->expression = $string;
		$this->index = $index;
	}

	public function compile(){
		return new Less_Tree_Anonymous('/* Sorry, can not do JavaScript evaluation in PHP... :( */');
	}

}
