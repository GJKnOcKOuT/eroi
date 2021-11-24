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
 * @package    arter\amos\tag
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\tag\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\tag\AmosTag;
use Yii;
use yii\helpers\ArrayHelper;

class WidgetIconTag extends WidgetIcon
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        $this->setLabel(AmosTag::tHtml('amostag', 'Tag'));
        $this->setDescription(AmosTag::t('amostag', 'Elenco dei widgets del plugin Tag'));
        $this->setIcon('tag');
        $this->setUrl(Yii::$app->urlManager->createUrl(['tag']));
        $this->setCode('TAG_MODULE');
        $this->setModuleName('tag');
        $this->setNamespace(__CLASS__);

        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(),
                [
                    'bk-backgroundIcon',
                    'color-secondary'
                ]
            )
        );
    }

    /**
     * Aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
     * 
     * @return type
     */
    public function getOptions()
    {
        return ArrayHelper::merge(
            parent::getOptions(),
            ['children' => $this->getWidgetsIcon()]
        );
    }

    /**
     * TEMPORANEA
     * 
     * @return type
     */
    public function getWidgetsIcon()
    {
        $widgets = [];

        //istanza di MyProfile
        $TagManager = new WidgetIconTagManager();
        if ($TagManager->isVisible()) {
            $widgets[] = $TagManager->getOptions();
        }

        return $widgets;
    }

}
