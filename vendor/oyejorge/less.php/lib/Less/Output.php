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
 * Parser output
 *
 * @package Less
 * @subpackage output
 */
class Less_Output{

	/**
	 * Output holder
	 *
	 * @var string
	 */
	protected $strs = array();

	/**
	 * Adds a chunk to the stack
	 *
	 * @param string $chunk The chunk to output
	 * @param Less_FileInfo $fileInfo The file information
	 * @param integer $index The index
	 * @param mixed $mapLines
	 */
	public function add($chunk, $fileInfo = null, $index = 0, $mapLines = null){
		$this->strs[] = $chunk;
	}

	/**
	 * Is the output empty?
	 *
	 * @return boolean
	 */
	public function isEmpty(){
		return count($this->strs) === 0;
	}


	/**
	 * Converts the output to string
	 *
	 * @return string
	 */
	public function toString(){
		return implode('',$this->strs);
	}

}