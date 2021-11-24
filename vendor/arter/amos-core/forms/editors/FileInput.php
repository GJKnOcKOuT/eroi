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
 * @package    arter\amos\core\forms\editors
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms\editors;

use dosamigos\fileinput\FileInput as YiiFileInput;
//use pendalf89\filemanager\widgets\FileInput as YiiFileInput;
use yii\helpers\ArrayHelper;

class FileInput extends YiiFileInput
{

    public $directInput = false;
   
    public function init()
    {
        parent::init();
      /*  $this->buttonTag = 'button';
        $this->buttonName = 'Sfoglia';
        $this->buttonOptions = ArrayHelper::merge($this->buttonOptions, ['class' => 'btn btn-success']);
        $this->resetButtonName = 'Rimuovi';
        $this->resetButtonOptions = ArrayHelper::merge($this->resetButtonOptions, ['class' => 'btn btn-danger']);
        $this->options = ArrayHelper::merge($this->options, ['class' => 'form-control']);
        $this->template = '<span class="hide">{input}</span>{button} {reset-button}';
        $this->thumb = 'medium';*/
        $this->customView = $this->getViewPath() . '/imageField.php';       
    }

    public function run()
    {
        if ($this->directInput) {
            return "######FILE INPUT######";
        } else {
            return parent::run();
        }
    }

}