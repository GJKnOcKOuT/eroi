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
 * Assignment
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_Assignment extends Less_Tree{

	public $key;
	public $value;
	public $type = 'Assignment';

    public function __construct($key, $val) {
		$this->key = $key;
		$this->value = $val;
	}

    public function accept( $visitor ){
		$this->value = $visitor->visitObj( $this->value );
	}

	public function compile($env) {
		return new Less_Tree_Assignment( $this->key, $this->value->compile($env));
	}

    /**
     * @see Less_Tree::genCSS
     */
	public function genCSS( $output ){
		$output->add( $this->key . '=' );
		$this->value->genCSS( $output );
	}

	public function toCss(){
		return $this->key . '=' . $this->value->toCSS();
	}
}
