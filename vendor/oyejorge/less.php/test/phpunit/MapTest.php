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


class phpunit_MapTest extends phpunit_bootstrap{


	/**
	 * Test
	 */
	public function testMap(){
		echo "\nBegin Tests";

		$less_file			= $this->fixtures_dir.'/bootstrap3-sourcemap/less/bootstrap.less';
		$map_file			= $this->fixtures_dir.'/bootstrap3-sourcemap/expected/bootstrap.map';
		$map_destination	= $this->cache_dir.'/bootstrap.map';



		$options['sourceMap']			= true;
		$options['sourceMapWriteTo']	= $map_destination;
		$options['sourceMapURL']		= '/';
		$options['sourceMapBasepath']	= dirname(dirname($less_file));


		$parser = new Less_Parser($options);
		$parser->parseFile($less_file);
		$css = $parser->getCss();

		$expected_map	= file_get_contents($map_file);
		$generated_map	= file_get_contents($map_destination);
		$this->assertEquals( $expected_map, $generated_map );

	}

}