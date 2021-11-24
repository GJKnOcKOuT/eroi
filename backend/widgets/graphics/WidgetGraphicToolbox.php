<?php
/**
 * Copyright 2020 Art-ER S. Cons. P.A.
 * EROI - Emilia Romagna Open Innovation is based on:
 * https://www.open2.0.regione.lombardia.it
 *
 * @package    backend\widgets\graphics
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace backend\widgets\graphics;

use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\widget\WidgetGraphic;

/**
 * Class WidgetGraphicToolbox
 * @package backend\widgets\graphics
 */
class WidgetGraphicToolbox extends WidgetGraphic
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setCode('TOOLBOX');
        $this->setLabel(BaseAmosModule::tHtml('aster', 'Risorse Utili'));
        $this->setDescription(BaseAmosModule::tHtml('aster', 'Risorse Utili'));
    }

    /**
     * @inheritdoc
     */
    public function getHtml()
    {
        return $this->render('toolbox', [
            'widget' => $this,
        ]);
    }
}
