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


namespace arter\amos\core\record;

use yii\base\Model;

/**
 * Class SearchResult
 *
 * This is the model class for the global search result in different plugins
 *
 * @package arter\amos\core\record
 */


class SearchResult extends Model {
    /**
     * @var integer identifier of the specific plugin's model
     */
    public $id;
    /**
     * @var string title of the search result
     */
    public $titolo;
     /**
     * @var string abstract of the search result
     */
    public $abstract;
    /**
     * @var date | null publication date of the search result
     */
    public $data_pubblicazione;
     /**
     * @var string box type of the search result. Possible values: "image" or "file" or "none"
     */
    public $box_type; 
     /**
     * @var \arter\amos\attachments\models\File | string | null  image of the search result (the file or the file path). Used only if $box_type is "image".
     */
    public $immagine;
     /**
     * @var \arter\amos\attachments\models\File | null  document of the search result. Used only if $box_type is "file".
     */
    public $documento;
     /**
     * @var string view url of the specific plugin's model
     */
    public $url;

    
   

    public function rules() {
        return [
           
        ];
    }

    public function attributeLabels() {
        return [
            
        ];
    }

    public function representingColumn() {
        return [
                //inserire il campo o i campi rappresentativi del modulo
        ];
    }

    public function attributeHints() {
        return [
        ];
    }

    /**
     * Returns the text hint for the specified attribute.
     * @param string $attribute the attribute name
     * @return string the attribute hint
     * @see attributeHints
     */
    public function getAttributeHint($attribute) {
        $hints = $this->attributeHints();
        return isset($hints[$attribute]) ? $hints[$attribute] : null;
    }

   

    public function __toString() {
        return "";
    }

}
?>