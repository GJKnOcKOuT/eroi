<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @see http://example.com Developers'community
 * @license GPLv3
 * @license https://opensource.org/licenses/gpl-3.0.html GNU General Public License version 3
 *
 * @package    arter\amos\core\views\toolbars
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\views\toolbars;


interface IStatsPanel
{

    public function getIcon();
    public function setIcon($icon);

    public function getLabel();
    public function setLabel($label);


    public function getDescription();
    public function setDescription($description);

    public function getCount();
    public function setCount($count);

    public function getUrl();
    public function setUrl($url);

    public function render($type);

}