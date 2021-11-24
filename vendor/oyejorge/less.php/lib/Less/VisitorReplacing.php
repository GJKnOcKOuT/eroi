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
 * Replacing Visitor
 *
 * @package Less
 * @subpackage visitor
 */
class Less_VisitorReplacing extends Less_Visitor{

	public function visitObj( $node ){

		$funcName = 'visit'.$node->type;
		if( isset($this->_visitFnCache[$funcName]) ){

			$visitDeeper = true;
			$node = $this->$funcName( $node, $visitDeeper );

			if( $node ){
				if( $visitDeeper && is_object($node) ){
					$node->accept($this);
				}

				$funcName = $funcName . "Out";
				if( isset($this->_visitFnCache[$funcName]) ){
					$this->$funcName( $node );
				}
			}

		}else{
			$node->accept($this);
		}

		return $node;
	}

	public function visitArray( $nodes ){

		$newNodes = array();
		foreach($nodes as $node){
			$evald = $this->visitObj($node);
			if( $evald ){
				if( is_array($evald) ){
					self::flatten($evald,$newNodes);
				}else{
					$newNodes[] = $evald;
				}
			}
		}
		return $newNodes;
	}

	public function flatten( $arr, &$out ){

		foreach($arr as $item){
			if( !is_array($item) ){
				$out[] = $item;
				continue;
			}

			foreach($item as $nestedItem){
				if( is_array($nestedItem) ){
					self::flatten( $nestedItem, $out);
				}else{
					$out[] = $nestedItem;
				}
			}
		}

		return $out;
	}

}


