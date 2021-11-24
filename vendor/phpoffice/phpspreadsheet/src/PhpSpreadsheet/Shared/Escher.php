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


namespace PhpOffice\PhpSpreadsheet\Shared;

class Escher
{
    /**
     * Drawing Group Container.
     *
     * @var Escher\DggContainer
     */
    private $dggContainer;

    /**
     * Drawing Container.
     *
     * @var Escher\DgContainer
     */
    private $dgContainer;

    /**
     * Get Drawing Group Container.
     *
     * @return Escher\DggContainer
     */
    public function getDggContainer()
    {
        return $this->dggContainer;
    }

    /**
     * Set Drawing Group Container.
     *
     * @param Escher\DggContainer $dggContainer
     *
     * @return Escher\DggContainer
     */
    public function setDggContainer($dggContainer)
    {
        return $this->dggContainer = $dggContainer;
    }

    /**
     * Get Drawing Container.
     *
     * @return Escher\DgContainer
     */
    public function getDgContainer()
    {
        return $this->dgContainer;
    }

    /**
     * Set Drawing Container.
     *
     * @param Escher\DgContainer $dgContainer
     *
     * @return Escher\DgContainer
     */
    public function setDgContainer($dgContainer)
    {
        return $this->dgContainer = $dgContainer;
    }
}
