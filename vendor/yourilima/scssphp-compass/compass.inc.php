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


class scss_compass {
	protected $libFunctions = array("lib_compact",'font_files');
	
	static public $true = array("keyword", "true");
	static public $false = array("keyword", "false");

	public function __construct($scss) {
		$this->scss = $scss;
		$this->updateImportPath();
		$this->registerFunctions();
	}

	protected function updateImportPath() {
		$this->scss->addImportPath(__DIR__ . "/stylesheets/");
	}

	protected function registerFunctions() {
		foreach ($this->libFunctions as $fn) {
			$registerName = $fn;
			if (preg_match('/^lib_(.*)$/', $fn, $m)) {
				$registerName = $m[1];
			}
			$registerName = str_replace('_','-',$registerName);
			$this->scss->registerFunction($registerName, array($this, $fn));
		}
	}

	public function lib_compact($args) {
		list($list) = $args;
		if ($list[0] != "list") return $list;

		$filtered = array();
		foreach ($list[2] as $item) {
			if ($item != self::$false) $filtered[] = $item;
		}
		$list[2] = $filtered;
		return $list;
	}

	public function font_files()
	{
		$files = func_get_args();
		$files = $files[0];
		$list = "";
		while(!empty($files)) {
			$file = array_shift($files);
			$file = $file[2][0];
			$type = array_shift($files);
			$type = $type[2][0];
			$list .= "font-url('$file') format('$type')";
			if (!empty($files))
				$list .= ", ";
		}
		return $list;
	}
}
