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
 * Operation
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_Operation extends Less_Tree{

	public $op;
	public $operands;
	public $isSpaced;
	public $type = 'Operation';

	/**
	 * @param string $op
	 */
	public function __construct($op, $operands, $isSpaced = false){
		$this->op = trim($op);
		$this->operands = $operands;
		$this->isSpaced = $isSpaced;
	}

    public function accept($visitor) {
		$this->operands = $visitor->visitArray($this->operands);
	}

	public function compile($env){
		$a = $this->operands[0]->compile($env);
		$b = $this->operands[1]->compile($env);


		if( Less_Environment::isMathOn() ){

			if( $a instanceof Less_Tree_Dimension && $b instanceof Less_Tree_Color ){
				$a = $a->toColor();

			}elseif( $b instanceof Less_Tree_Dimension && $a instanceof Less_Tree_Color ){
				$b = $b->toColor();

			}

			if( !method_exists($a,'operate') ){
				throw new Less_Exception_Compiler("Operation on an invalid type");
			}

			return $a->operate( $this->op, $b);
		}

		return new Less_Tree_Operation($this->op, array($a, $b), $this->isSpaced );
	}


    /**
     * @see Less_Tree::genCSS
     */
    public function genCSS( $output ){
		$this->operands[0]->genCSS( $output );
		if( $this->isSpaced ){
			$output->add( " " );
		}
		$output->add( $this->op );
		if( $this->isSpaced ){
			$output->add( ' ' );
		}
		$this->operands[1]->genCSS( $output );
	}

}
