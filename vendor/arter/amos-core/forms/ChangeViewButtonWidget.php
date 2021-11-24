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
 * @package    arter\amos\core\forms
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\core\forms;

use arter\amos\core\helpers\Html;
use arter\amos\core\record\Record;
use Yii;
use yii\base\Widget;

/**
 * Class CreateNewButtonWidget
 * Renders the "create new" button also according to the permissions that the user has.
 *
 * @package arter\amos\core\forms
 */
class ChangeViewButtonWidget extends Widget
{
    /**
     * @var string $createNewBtnLabel Label for create button. Default to "Crea nuovo".
     */
    public $htmlButtons = [];


    /**
     * @return string
     */
    public function run()
    {
        return $this->renderButtons();
    }


    /**
     * @return string
     */
    public function renderButtons()
    {
       $content = '';
       foreach ($this->htmlButtons as $button){
           $content .=  $button;
       }
       return $content;
    }
}
