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
 * Join Selector Visitor
 *
 * @package Less
 * @subpackage visitor
 */
class Less_Visitor_joinSelector extends Less_Visitor{

	public $contexts = array( array() );

	/**
	 * @param Less_Tree_Ruleset $root
	 */
	public function run( $root ){
		return $this->visitObj($root);
	}

    public function visitRule( $ruleNode, &$visitDeeper ){
		$visitDeeper = false;
	}

    public function visitMixinDefinition( $mixinDefinitionNode, &$visitDeeper ){
		$visitDeeper = false;
	}

    public function visitRuleset( $rulesetNode ){

		$paths = array();

		if( !$rulesetNode->root ){
			$selectors = array();

			if( $rulesetNode->selectors && $rulesetNode->selectors ){
				foreach($rulesetNode->selectors as $selector){
					if( $selector->getIsOutput() ){
						$selectors[] = $selector;
					}
				}
			}

			if( !$selectors ){
				$rulesetNode->selectors = null;
				$rulesetNode->rules = null;
			}else{
				$context = end($this->contexts); //$context = $this->contexts[ count($this->contexts) - 1];
				$paths = $rulesetNode->joinSelectors( $context, $selectors);
			}

			$rulesetNode->paths = $paths;
		}

		$this->contexts[] = $paths; //different from less.js. Placed after joinSelectors() so that $this->contexts will get correct $paths
	}

    public function visitRulesetOut(){
		array_pop($this->contexts);
	}

    public function visitMedia($mediaNode) {
		$context = end($this->contexts); //$context = $this->contexts[ count($this->contexts) - 1];

		if( !count($context) || (is_object($context[0]) && $context[0]->multiMedia) ){
			$mediaNode->rules[0]->root = true;
		}
	}

}

