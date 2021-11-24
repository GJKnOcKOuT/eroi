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


namespace PhpOffice\PhpSpreadsheet\Reader\Xlsx;

use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class DataValidations
{
    private $worksheet;

    private $worksheetXml;

    public function __construct(Worksheet $workSheet, \SimpleXMLElement $worksheetXml)
    {
        $this->worksheet = $workSheet;
        $this->worksheetXml = $worksheetXml;
    }

    public function load()
    {
        foreach ($this->worksheetXml->dataValidations->dataValidation as $dataValidation) {
            // Uppercase coordinate
            $range = strtoupper($dataValidation['sqref']);
            $rangeSet = explode(' ', $range);
            foreach ($rangeSet as $range) {
                $stRange = $this->worksheet->shrinkRangeToFit($range);

                // Extract all cell references in $range
                foreach (Coordinate::extractAllCellReferencesInRange($stRange) as $reference) {
                    // Create validation
                    $docValidation = $this->worksheet->getCell($reference)->getDataValidation();
                    $docValidation->setType((string) $dataValidation['type']);
                    $docValidation->setErrorStyle((string) $dataValidation['errorStyle']);
                    $docValidation->setOperator((string) $dataValidation['operator']);
                    $docValidation->setAllowBlank($dataValidation['allowBlank'] != 0);
                    $docValidation->setShowDropDown($dataValidation['showDropDown'] == 0);
                    $docValidation->setShowInputMessage($dataValidation['showInputMessage'] != 0);
                    $docValidation->setShowErrorMessage($dataValidation['showErrorMessage'] != 0);
                    $docValidation->setErrorTitle((string) $dataValidation['errorTitle']);
                    $docValidation->setError((string) $dataValidation['error']);
                    $docValidation->setPromptTitle((string) $dataValidation['promptTitle']);
                    $docValidation->setPrompt((string) $dataValidation['prompt']);
                    $docValidation->setFormula1((string) $dataValidation->formula1);
                    $docValidation->setFormula2((string) $dataValidation->formula2);
                }
            }
        }
    }
}
