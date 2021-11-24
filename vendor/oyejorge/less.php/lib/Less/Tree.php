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
 * Tree
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree{

	public $cache_string;

	public function toCSS(){
		$output = new Less_Output();
		$this->genCSS($output);
		return $output->toString();
	}


    /**
     * Generate CSS by adding it to the output object
     *
     * @param Less_Output $output The output
     * @return void
     */
    public function genCSS($output){}


	/**
	 * @param Less_Tree_Ruleset[] $rules
	 */
	public static function outputRuleset( $output, $rules ){

		$ruleCnt = count($rules);
		Less_Environment::$tabLevel++;


		// Compressed
		if( Less_Parser::$options['compress'] ){
			$output->add('{');
			for( $i = 0; $i < $ruleCnt; $i++ ){
				$rules[$i]->genCSS( $output );
			}

			$output->add( '}' );
			Less_Environment::$tabLevel--;
			return;
		}


		// Non-compressed
		$tabSetStr = "\n".str_repeat( Less_Parser::$options['indentation'] , Less_Environment::$tabLevel-1 );
		$tabRuleStr = $tabSetStr.Less_Parser::$options['indentation'];

		$output->add( " {" );
		for($i = 0; $i < $ruleCnt; $i++ ){
			$output->add( $tabRuleStr );
			$rules[$i]->genCSS( $output );
		}
		Less_Environment::$tabLevel--;
		$output->add( $tabSetStr.'}' );

	}

	public function accept($visitor){}


	public static function ReferencedArray($rules){
		foreach($rules as $rule){
			if( method_exists($rule, 'markReferenced') ){
				$rule->markReferenced();
			}
		}
	}


	/**
	 * Requires php 5.3+
	 */
	public static function __set_state($args){

		$class = get_called_class();
		$obj = new $class(null,null,null,null);
		foreach($args as $key => $val){
			$obj->$key = $val;
		}
		return $obj;
	}

}
