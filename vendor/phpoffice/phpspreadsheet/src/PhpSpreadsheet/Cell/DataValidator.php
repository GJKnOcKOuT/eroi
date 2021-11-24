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


namespace PhpOffice\PhpSpreadsheet\Cell;

use PhpOffice\PhpSpreadsheet\Calculation\Calculation;
use PhpOffice\PhpSpreadsheet\Calculation\Functions;
use PhpOffice\PhpSpreadsheet\Exception;

/**
 * Validate a cell value according to its validation rules.
 */
class DataValidator
{
    /**
     * Does this cell contain valid value?
     *
     * @param Cell $cell Cell to check the value
     *
     * @return bool
     */
    public function isValid(Cell $cell)
    {
        if (!$cell->hasDataValidation()) {
            return true;
        }

        $cellValue = $cell->getValue();
        $dataValidation = $cell->getDataValidation();

        if (!$dataValidation->getAllowBlank() && ($cellValue === null || $cellValue === '')) {
            return false;
        }

        // TODO: write check on all cases
        switch ($dataValidation->getType()) {
            case DataValidation::TYPE_LIST:
                return $this->isValueInList($cell);
        }

        return false;
    }

    /**
     * Does this cell contain valid value, based on list?
     *
     * @param Cell $cell Cell to check the value
     *
     * @return bool
     */
    private function isValueInList(Cell $cell)
    {
        $cellValue = $cell->getValue();
        $dataValidation = $cell->getDataValidation();

        $formula1 = $dataValidation->getFormula1();
        if (!empty($formula1)) {
            // inline values list
            if ($formula1[0] === '"') {
                return in_array(strtolower($cellValue), explode(',', strtolower(trim($formula1, '"'))), true);
            } elseif (strpos($formula1, ':') > 0) {
                // values list cells
                $matchFormula = '=MATCH(' . $cell->getCoordinate() . ', ' . $formula1 . ', 0)';
                $calculation = Calculation::getInstance($cell->getWorksheet()->getParent());

                try {
                    $result = $calculation->calculateFormula($matchFormula, $cell->getCoordinate(), $cell);

                    return $result !== Functions::NA();
                } catch (Exception $ex) {
                    return false;
                }
            }
        }

        return true;
    }
}
