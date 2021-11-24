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
 * Anonymous
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_Anonymous extends Less_Tree{
	public $value;
	public $quote;
	public $index;
	public $mapLines;
	public $currentFileInfo;
	public $type = 'Anonymous';

	/**
	 * @param integer $index
	 * @param boolean $mapLines
	 */
	public function __construct($value, $index = null, $currentFileInfo = null, $mapLines = null ){
		$this->value = $value;
		$this->index = $index;
		$this->mapLines = $mapLines;
		$this->currentFileInfo = $currentFileInfo;
	}

	public function compile(){
		return new Less_Tree_Anonymous($this->value, $this->index, $this->currentFileInfo, $this->mapLines);
	}

    public function compare($x){
		if( !is_object($x) ){
			return -1;
		}

		$left = $this->toCSS();
		$right = $x->toCSS();

		if( $left === $right ){
			return 0;
		}

		return $left < $right ? -1 : 1;
	}

    /**
     * @see Less_Tree::genCSS
     */
	public function genCSS( $output ){
		$output->add( $this->value, $this->currentFileInfo, $this->index, $this->mapLines );
	}

	public function toCSS(){
		return $this->value;
	}

}
