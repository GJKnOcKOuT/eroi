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
 * DetachedRuleset
 *
 * @package Less
 * @subpackage tree
 */
class Less_Tree_DetachedRuleset extends Less_Tree{

	public $ruleset;
	public $frames;
	public $type = 'DetachedRuleset';

    public function __construct( $ruleset, $frames = null ){
		$this->ruleset = $ruleset;
		$this->frames = $frames;
	}

    public function accept($visitor) {
		$this->ruleset = $visitor->visitObj($this->ruleset);
	}

    public function compile($env){
		if( $this->frames ){
			$frames = $this->frames;
		}else{
			$frames = $env->frames;
		}
		return new Less_Tree_DetachedRuleset($this->ruleset, $frames);
	}

    public function callEval($env) {
		if( $this->frames ){
			return $this->ruleset->compile( $env->copyEvalEnv( array_merge($this->frames,$env->frames) ) );
		}
		return $this->ruleset->compile( $env );
	}
}

