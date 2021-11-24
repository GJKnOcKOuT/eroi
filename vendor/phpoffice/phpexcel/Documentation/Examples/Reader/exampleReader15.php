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


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>PHPExcel Reader Example #15</title>

</head>
<body>

<h1>PHPExcel Reader Example #15</h1>
<h2>Simple File Reader for Tab-Separated Value File using the Advanced Value Binder</h2>
<?php

/** Include path **/
set_include_path(get_include_path() . PATH_SEPARATOR . '../../../Classes/');

/** PHPExcel_IOFactory */
include 'PHPExcel/IOFactory.php';


PHPExcel_Cell::setValueBinder( new PHPExcel_Cell_AdvancedValueBinder() );


$inputFileType = 'CSV';
$inputFileName = './sampleData/example1.tsv';

$objReader = PHPExcel_IOFactory::createReader($inputFileType);
echo 'Loading file ',pathinfo($inputFileName,PATHINFO_BASENAME),' into WorkSheet #1 using IOFactory with a defined reader type of ',$inputFileType,'<br />';
$objReader->setDelimiter("\t");
$objPHPExcel = $objReader->load($inputFileName);
$objPHPExcel->getActiveSheet()->setTitle(pathinfo($inputFileName,PATHINFO_BASENAME));


echo '<hr />';

echo $objPHPExcel->getSheetCount(),' worksheet',(($objPHPExcel->getSheetCount() == 1) ? '' : 's'),' loaded<br /><br />';
$loadedSheetNames = $objPHPExcel->getSheetNames();
foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
	echo '<b>Worksheet #',$sheetIndex,' -> ',$loadedSheetName,' (Formatted)</b><br />';
	$objPHPExcel->setActiveSheetIndexByName($loadedSheetName);
	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
	var_dump($sheetData);
	echo '<br />';
}

echo '<hr />';

foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
	echo '<b>Worksheet #',$sheetIndex,' -> ',$loadedSheetName,' (Unformatted)</b><br />';
	$objPHPExcel->setActiveSheetIndexByName($loadedSheetName);
	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,false,true);
	var_dump($sheetData);
	echo '<br />';
}

echo '<hr />';

foreach($loadedSheetNames as $sheetIndex => $loadedSheetName) {
	echo '<b>Worksheet #',$sheetIndex,' -> ',$loadedSheetName,' (Raw)</b><br />';
	$objPHPExcel->setActiveSheetIndexByName($loadedSheetName);
	$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,false,false,true);
	var_dump($sheetData);
	echo '<br />';
}

?>
<body>
</html>