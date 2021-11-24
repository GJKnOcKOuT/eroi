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
 * Comment
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_Comment extends Less_Tree{

	public $value;
	public $silent;
	public $isReferenced;
	public $currentFileInfo;
	public $type = 'Comment';

	public function __construct($value, $silent, $index = null, $currentFileInfo = null ){
		$this->value = $value;
		$this->silent = !! $silent;
		$this->currentFileInfo = $currentFileInfo;
	}

    /**
     * @see Less_Tree::genCSS
     */
	public function genCSS( $output ){
		//if( $this->debugInfo ){
			//$output->add( tree.debugInfo($env, $this), $this->currentFileInfo, $this->index);
		//}
		$output->add( trim($this->value) );//TODO shouldn't need to trim, we shouldn't grab the \n
	}

	public function toCSS(){
		return Less_Parser::$options['compress'] ? '' : $this->value;
	}

	public function isSilent(){
		$isReference = ($this->currentFileInfo && isset($this->currentFileInfo['reference']) && (!isset($this->isReferenced) || !$this->isReferenced) );
		$isCompressed = Less_Parser::$options['compress'] && !preg_match('/^\/\*!/', $this->value);
		return $this->silent || $isReference || $isCompressed;
	}

	public function compile(){
		return $this;
	}

	public function markReferenced(){
		$this->isReferenced = true;
	}

}
