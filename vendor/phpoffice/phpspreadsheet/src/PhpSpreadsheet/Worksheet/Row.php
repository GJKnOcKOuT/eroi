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


namespace PhpOffice\PhpSpreadsheet\Worksheet;

class Row
{
    /**
     * \PhpOffice\PhpSpreadsheet\Worksheet\Worksheet.
     *
     * @var Worksheet
     */
    private $worksheet;

    /**
     * Row index.
     *
     * @var int
     */
    private $rowIndex = 0;

    /**
     * Create a new row.
     *
     * @param Worksheet $worksheet
     * @param int $rowIndex
     */
    public function __construct(Worksheet $worksheet = null, $rowIndex = 1)
    {
        // Set parent and row index
        $this->worksheet = $worksheet;
        $this->rowIndex = $rowIndex;
    }

    /**
     * Destructor.
     */
    public function __destruct()
    {
        unset($this->worksheet);
    }

    /**
     * Get row index.
     *
     * @return int
     */
    public function getRowIndex()
    {
        return $this->rowIndex;
    }

    /**
     * Get cell iterator.
     *
     * @param string $startColumn The column address at which to start iterating
     * @param string $endColumn Optionally, the column address at which to stop iterating
     *
     * @return RowCellIterator
     */
    public function getCellIterator($startColumn = 'A', $endColumn = null)
    {
        return new RowCellIterator($this->worksheet, $this->rowIndex, $startColumn, $endColumn);
    }

    /**
     * Returns bound worksheet.
     *
     * @return Worksheet
     */
    public function getWorksheet()
    {
        return $this->worksheet;
    }
}
