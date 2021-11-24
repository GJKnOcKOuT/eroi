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


class phpunit_FunctionTest extends phpunit_bootstrap{
	/**
	 * Test
	 */
	public function testFunction() {
		echo "\nBegin Tests";

		$less_file = $this->fixtures_dir.'/functions/less/f1.less';
		$expected_css = file_get_contents( $this->fixtures_dir.'/functions/css/f1.css' );

		$parser = new Less_Parser();

		$parser->registerFunction( 'myfunc-reverse', array( __CLASS__, 'reverse' ) );

		$parser->parseFile( $less_file );
		$generated_css = $parser->getCss();

		$this->assertEquals( $expected_css, $generated_css );
	}

	public static function reverse( $arg ) {
		if( is_a( $arg, 'Less_Tree_Quoted' ) ) {
			$arg->value = strrev( $arg->value );
			return $arg;
		}
	}
}