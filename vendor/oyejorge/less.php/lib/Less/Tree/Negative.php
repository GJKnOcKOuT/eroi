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
 * Negative
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_Negative extends Less_Tree{

	public $value;
	public $type = 'Negative';

    public function __construct($node){
		$this->value = $node;
	}

	//function accept($visitor) {
	//	$this->value = $visitor->visit($this->value);
	//}

    /**
     * @see Less_Tree::genCSS
     */
    public function genCSS( $output ){
		$output->add( '-' );
		$this->value->genCSS( $output );
	}

    public function compile($env) {
		if( Less_Environment::isMathOn() ){
			$ret = new Less_Tree_Operation('*', array( new Less_Tree_Dimension(-1), $this->value ) );
			return $ret->compile($env);
		}
		return new Less_Tree_Negative( $this->value->compile($env) );
	}
}