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
 * Attribute
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_Attribute extends Less_Tree{

	public $key;
	public $op;
	public $value;
	public $type = 'Attribute';

    public function __construct($key, $op, $value){
		$this->key = $key;
		$this->op = $op;
		$this->value = $value;
	}

    public function compile($env){

		$key_obj = is_object($this->key);
		$val_obj = is_object($this->value);

		if( !$key_obj && !$val_obj ){
			return $this;
		}

		return new Less_Tree_Attribute(
			$key_obj ? $this->key->compile($env) : $this->key ,
			$this->op,
			$val_obj ? $this->value->compile($env) : $this->value);
	}

    /**
     * @see Less_Tree::genCSS
     */
    public function genCSS( $output ){
		$output->add( $this->toCSS() );
	}

    public function toCSS(){
		$value = $this->key;

		if( $this->op ){
			$value .= $this->op;
			$value .= (is_object($this->value) ? $this->value->toCSS() : $this->value);
		}

		return '[' . $value . ']';
	}
}