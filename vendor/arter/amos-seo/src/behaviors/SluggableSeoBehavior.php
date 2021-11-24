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
 * @package    arter\amos\seo\behaviors
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\seo\behaviors;

use yii\behaviors\SluggableBehavior;


/**
 * Class SluggableAmosBehavior
 * @package arter\amos\core\behaviors
 */
class SluggableSeoBehavior extends SluggableBehavior {
    
    public $maxLengthSlug;
    
    public function makeSeoUnique($slug) {
        return $this->makeUnique($slug);
    }
    
    public function generateSeoSlug($text) {
        return $this->generateSlug($text);
    }
    
    public function generateUniqueSeoSlug($text) {
        $text = str_replace("\n", " ", $text); // textarea

        $text = str_replace("&nbsp;", " ", $text);
        $text = str_replace(array("'", '"'), "", $text); //remove single quote and dash
        $text = mb_convert_case($text, MB_CASE_LOWER, "UTF-8"); //convert to lowercase
        $text = preg_replace("#[^a-zA-Z0-9]+#", "-", $text); //replace everything non an with dashes
        $text = preg_replace("#(-){2,}#", "$1", $text); //replace multiple dashes with one
        $text = trim($text, "-"); //trim dashes from beginning and end of string if any

        if ($this->maxLengthSlug) {
            $text = substr($text, 0, $this->maxLengthSlug);
        }
        return $this->makeUnique($this->generateSlug([$text]));
    }

}
