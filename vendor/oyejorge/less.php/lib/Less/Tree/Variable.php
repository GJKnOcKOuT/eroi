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
 * Variable
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_Variable extends Less_Tree{

	public $name;
	public $index;
	public $currentFileInfo;
	public $evaluating = false;
	public $type = 'Variable';

    /**
     * @param string $name
     */
    public function __construct($name, $index = null, $currentFileInfo = null) {
        $this->name = $name;
        $this->index = $index;
		$this->currentFileInfo = $currentFileInfo;
    }

	public function compile($env) {

		if( $this->name[1] === '@' ){
			$v = new Less_Tree_Variable(substr($this->name, 1), $this->index + 1, $this->currentFileInfo);
			$name = '@' . $v->compile($env)->value;
		}else{
			$name = $this->name;
		}

		if ($this->evaluating) {
			throw new Less_Exception_Compiler("Recursive variable definition for " . $name, null, $this->index, $this->currentFileInfo);
		}

		$this->evaluating = true;

		foreach($env->frames as $frame){
			if( $v = $frame->variable($name) ){
				$r = $v->value->compile($env);
				$this->evaluating = false;
				return $r;
			}
		}

		throw new Less_Exception_Compiler("variable " . $name . " is undefined in file ".$this->currentFileInfo["filename"], null, $this->index, $this->currentFileInfo);
	}

}
