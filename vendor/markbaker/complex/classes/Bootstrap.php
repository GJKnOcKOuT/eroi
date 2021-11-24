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


include_once __DIR__ . '/Autoloader.php';

\Complex\Autoloader::Register();


abstract class FilesystemRegexFilter extends RecursiveRegexIterator
{
    protected $regex;
    public function __construct(RecursiveIterator $it, $regex)
    {
        $this->regex = $regex;
        parent::__construct($it, $regex);
    }
}

class FilenameFilter extends FilesystemRegexFilter
{
    // Filter files against the regex
    public function accept()
    {
        return (!$this->isFile() || preg_match($this->regex, $this->getFilename()));
    }
}


$srcFolder = __DIR__ . DIRECTORY_SEPARATOR . 'src';
$srcDirectory = new RecursiveDirectoryIterator($srcFolder);

$filteredFileList = new FilenameFilter($srcDirectory, '/(?:php)$/i');
$filteredFileList = new FilenameFilter($filteredFileList, '/^(?!.*(Complex|Exception)\.php).*$/i');

foreach (new RecursiveIteratorIterator($filteredFileList) as $file) {
    if ($file->isFile()) {
        include_once $file;
    }
}
