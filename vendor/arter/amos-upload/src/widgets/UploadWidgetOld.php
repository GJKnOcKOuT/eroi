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
 * @package    arter\amos\upload
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\upload\widgets;

use yii\base\Widget;
use yii\helpers\Html;

class UploadWidget extends Widget
{
    public $message;
    public function init()
    {
        parent::init();
        if($this->message === null){
            $this->message = "Benvenuto nel widget";
        }
        else{
            $this->message = "Benvenuto " . $this->message;
        }
    }

    public function run() 
    {
        
        return $this->render('upload');
    }
}