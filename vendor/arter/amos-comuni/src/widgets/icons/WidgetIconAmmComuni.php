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
 * @package    arter\amos\comuni
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\comuni\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use Yii;
use yii\helpers\ArrayHelper;
use arter\amos\comuni\AmosComuni;

class WidgetIconAmmComuni extends WidgetIcon
{

    public function init()
    {
        parent::init();

        $this->setLabel(AmosComuni::t('amoscomuni', 'Comuni'));
        $this->setDescription(AmosComuni::t('amoscomuni', 'Elenco dei widget di amministrazione del plugin Comuni'));

        $this->setIcon('balance');
        $this->setIconFramework('am');
        $this->setUrl(Yii::$app->urlManager->createUrl(['/comuni/dashboard/index']));
        $this->setCode('ADMIN_COMUNI');
        $this->setModuleName('comuni');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(ArrayHelper::merge($this->getClassSpan(), [
            'bk-backgroundIcon',
            'color-grey'
        ]));

    }

    public function getOptions()
    {
        $options = parent::getOptions();

        //aggiunge all'oggetto container tutti i widgets recuperati dal controller del modulo
        return ArrayHelper::merge($options, ["children" => $this->getWidgetsIcon()]);
    }

    public function getWidgetsIcon()
    {
        return AmosWidgets::find()
            ->andWhere([
                'child_of' => self::className()
            ])->all();
    }
}