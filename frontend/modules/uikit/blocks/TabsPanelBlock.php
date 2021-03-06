<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    arter
 * @category   CategoryName
 */

namespace app\modules\uikit\blocks;


use app\modules\uikit\Module;
use luya\cms\frontend\blockgroups\TextGroup;


final class TabsPanelBlock extends \app\modules\uikit\BaseUikitBlock
{
    
    
    protected $component = "tabspanel";
    
    
    //put your code here
    public function admin() 
    {
        if(count($this->getVarValue('items', []))) {
            return $this->frontend();
        } else {
            return '<div><span class="block__empty-text">' . Module::t('no_content') . '</span></div>';
        }
    }

    public function name() {
        return Module::t('tabspanel');
    }

   /**
     * @inheritDoc
     */
    public function blockGroup()
    {
        return TextGroup::class;
    }

    /**
     * @inheritDoc
     */
    public function icon()
    {
        return 'format_color_text';
    }
}
