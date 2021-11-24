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
 * Value
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_Value extends Less_Tree{

	public $type = 'Value';
	public $value;

	public function __construct($value){
		$this->value = $value;
	}

    public function accept($visitor) {
		$this->value = $visitor->visitArray($this->value);
	}

	public function compile($env){

		$ret = array();
		$i = 0;
		foreach($this->value as $i => $v){
			$ret[] = $v->compile($env);
		}
		if( $i > 0 ){
			return new Less_Tree_Value($ret);
		}
		return $ret[0];
	}

    /**
     * @see Less_Tree::genCSS
     */
	function genCSS( $output ){
		$len = count($this->value);
		for($i = 0; $i < $len; $i++ ){
			$this->value[$i]->genCSS( $output );
			if( $i+1 < $len ){
				$output->add( Less_Environment::$_outputMap[','] );
			}
		}
	}

}
