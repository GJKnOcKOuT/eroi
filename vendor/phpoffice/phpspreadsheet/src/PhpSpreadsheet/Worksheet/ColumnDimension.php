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

class ColumnDimension extends Dimension
{
    /**
     * Column index.
     *
     * @var string
     */
    private $columnIndex;

    /**
     * Column width.
     *
     * When this is set to a negative value, the column width should be ignored by IWriter
     *
     * @var float
     */
    private $width = -1;

    /**
     * Auto size?
     *
     * @var bool
     */
    private $autoSize = false;

    /**
     * Create a new ColumnDimension.
     *
     * @param string $pIndex Character column index
     */
    public function __construct($pIndex = 'A')
    {
        // Initialise values
        $this->columnIndex = $pIndex;

        // set dimension as unformatted by default
        parent::__construct(0);
    }

    /**
     * Get ColumnIndex.
     *
     * @return string
     */
    public function getColumnIndex()
    {
        return $this->columnIndex;
    }

    /**
     * Set ColumnIndex.
     *
     * @param string $pValue
     *
     * @return ColumnDimension
     */
    public function setColumnIndex($pValue)
    {
        $this->columnIndex = $pValue;

        return $this;
    }

    /**
     * Get Width.
     *
     * @return float
     */
    public function getWidth()
    {
        return $this->width;
    }

    /**
     * Set Width.
     *
     * @param float $pValue
     *
     * @return ColumnDimension
     */
    public function setWidth($pValue)
    {
        $this->width = $pValue;

        return $this;
    }

    /**
     * Get Auto Size.
     *
     * @return bool
     */
    public function getAutoSize()
    {
        return $this->autoSize;
    }

    /**
     * Set Auto Size.
     *
     * @param bool $pValue
     *
     * @return ColumnDimension
     */
    public function setAutoSize($pValue)
    {
        $this->autoSize = $pValue;

        return $this;
    }
}
