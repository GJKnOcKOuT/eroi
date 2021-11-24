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
 * @package    arter\amos\documenti\widgets\icons
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\documenti\widgets\icons;

use arter\amos\core\widget\WidgetIcon;
use arter\amos\uploader\Module;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class WidgetIconUploader
 * @package arter\amos\documenti\widgets\icons
 */
class WidgetIconUploader extends WidgetIcon
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        
        $isEdge = false;
        if (preg_match("/Edge/i", $_SERVER['HTTP_USER_AGENT'], $output_array)) {
            $isEdge = true;
        }

        if (preg_match("/Explorer/i", $_SERVER['HTTP_USER_AGENT'], $output_array)) {
            $isEdge = true;
        }

        if (preg_match("/Trident/i", $_SERVER['HTTP_USER_AGENT'], $output_array)) {
            $isEdge = true;
        }

        $url = '/dashboard';
        if (!$isEdge) {
            $url = ['/uploader/upload/index', 'callbackUrl' => '/import/default/extract'];
        } else {
            $js = <<<JS
            $('.alert-import').click(function(event){
                event.preventDefault();
                alert("L'importazione delle aree di lavoro è supportata completamente utilizzando il web browser Chrome; perciò per eseguirla è necessario usare questo browser: apri Chrome, accedi alla piattaforma ed esegui di nuovo questa funzione.");
            });
JS;
            $controller = Yii::$app->controller;
            $view = $controller->getView();
            $view->registerJs($js);
        }

        $this->setLabel(AmosDocumenti::t('amosdocumenti', 'Import Workspace'));
        $this->setDescription(AmosDocumenti::t('amosdocumenti', 'Upload files of great size'));
        $this->setIcon('linentita');
        $this->setUrl($url);
        $this->setCode('UPLOADER');
        $this->setModuleName('uploader');
        $this->setNamespace(__CLASS__);
        $this->setClassSpan(
            ArrayHelper::merge(
                $this->getClassSpan(), 
                [
                    'bk-backgroundIcon',
                    'color-darkGrey',
                    'alert-import'
                ]
            )
        );
    }

}
