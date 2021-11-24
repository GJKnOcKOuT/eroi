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
 * A simple css name-value pair
 * ex: width:100px;
 *
 * In bootstrap, there are about 600-1,000 simple name-value pairs (depending on how forgiving the match is) -vs- 6,020 dynamic rules (Less_Tree_Rule)
 * Using the name-value object can speed up bootstrap compilation slightly, but it breaks color keyword interpretation: color:red -> color:#FF0000;
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_NameValue extends Less_Tree{

	public $name;
	public $value;
	public $index;
	public $currentFileInfo;
	public $type = 'NameValue';
	public $important = '';

	public function __construct($name, $value = null, $index = null, $currentFileInfo = null ){
		$this->name = $name;
		$this->value = $value;
		$this->index = $index;
		$this->currentFileInfo = $currentFileInfo;
	}

    public function genCSS( $output ){

		$output->add(
			$this->name
			. Less_Environment::$_outputMap[': ']
			. $this->value
			. $this->important
			. (((Less_Environment::$lastRule && Less_Parser::$options['compress'])) ? "" : ";")
			, $this->currentFileInfo, $this->index);
	}

	public function compile ($env){
		return $this;
	}

	public function makeImportant(){
		$new = new Less_Tree_NameValue($this->name, $this->value, $this->index, $this->currentFileInfo);
		$new->important = ' !important';
		return $new;
	}


}
