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
 * @package    arter\amos\community\widgets
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\community\widgets;

use arter\amos\community\AmosCommunity;
use arter\amos\community\models\Community;
use arter\amos\community\utilities\CommunityUtil;
use arter\amos\core\forms\ContextMenuWidget;
use arter\amos\core\helpers\Html;
use arter\amos\core\icons\AmosIcons;
use arter\amos\core\module\BaseAmosModule;
use arter\amos\core\views\ListView;
use arter\amos\dashboard\models\AmosWidgets;
use arter\amos\dashboard\models\search\AmosWidgetsSearch;
use arter\amos\notificationmanager\forms\NewsWidget;
use Yii;
use yii\base\Widget;
use yii\data\ArrayDataProvider;
use yii\web\ForbiddenHttpException;

/**
 * Class CommunityCardWidget
 * @package arter\amos\community\widgets
 */
class ConfigureDashboardCommunityWidget extends Widget
{
    /**
     * @var Community $model
     */
    public $model;


    /**
     * widget initialization
     */
    public function init()
    {
        parent::init();

        if (is_null($this->model)) {
            throw new \Exception(AmosCommunity::t('amoscommunity', 'Missing model'));
        }
    }

    /**
     * @return string
     * @throws ForbiddenHttpException
     */
    public function run()
    {
        $params = self::getDashBoardWidgets($this->model);
        return $this->render('configure_dashboard_community', $params);
    }


    /**
     * @param $model
     * @return array
     * @throws ForbiddenHttpException
     * @throws \yii\base\InvalidConfigException
     */
    public static function getDashBoardWidgets($model){
        $canPersonalize = \Yii::$app->user->can('COMMUNITY_WIDGETS_ADMIN_PERSONALIZE');
        $util = new CommunityUtil();
        if(!($util->isManagerLoggedUser($model) || \Yii::$app->user->can('ADMIN') || $model->isNewRecord)){
            throw new ForbiddenHttpException('Accesso negato');
        }


        $widgetSelected       = [];
        $widgetIconsSelected = $model->amosWidgetsIcons;
        foreach ($widgetIconsSelected as $widget) {
            $widgetSelected[] = $widget->id;
        }
        $widgetGraphicsSelected = $model->amosWidgetsGraphics;
        foreach ($widgetGraphicsSelected as $widget) {
            $widgetSelected[] = $widget->id;
        }


        // --------- WIDGET ICONS
        if($canPersonalize){
            $widgetIconSelectable = AmosWidgetsSearch::selectableIcon(0, null, true, true)->all();
        } else {
            $widgetIconSelectable = AmosWidgetsSearch::selectableIcon(1, 'community', true, true)->all();
        }
        //remove widget not visible
        $widgetPartecipanti = AmosWidgets::findOne(['classname' => 'arter\amos\admin\widgets\icons\WidgetIconUserProfile']);
        $widgetIconsSelectableCopy = [$widgetPartecipanti];
        foreach ($widgetIconSelectable as $key => $iconSelectable){
            $obj = Yii::createObject($iconSelectable->classname);
            if($obj->isVisible()){
                $widgetIconsSelectableCopy[]= $iconSelectable;
            }
        }

        $widgetIconSelectable = $widgetIconsSelectableCopy;
        $providerIcon = new ArrayDataProvider(['allModels' => $widgetIconSelectable, 'pagination' => false]);


        // ----------  WIDGET GRAPHICS
        $widgetGraphicSelectableCopy =[];
        if($canPersonalize) {
            $widgetGraphicSelectable = AmosWidgetsSearch::selectableGraphic(0, null, true, true)->all();
        } else {
            $widgetGraphicSelectable = AmosWidgetsSearch::selectableGraphic(1, 'community', true, true)->all();
        }
            //remove widget not visible
        foreach ($widgetGraphicSelectable as $key => $graphicSelectable){
            $obj = Yii::createObject($graphicSelectable->classname);
            if($obj->isVisible()){
                $widgetGraphicSelectableCopy[]= $graphicSelectable;
            }
        }

        $widgetGraphicSelectable = $widgetGraphicSelectableCopy;
        $providerGraphic = new ArrayDataProvider([
            'allModels' => $widgetGraphicSelectable,
            'pagination' => false,
        ]);


        $params = [
            'widgetIconSelectable' => $widgetIconSelectable,
            'widgetGraphicSelectable' => $widgetGraphicSelectable,
            'widgetSelected' => $widgetSelected,
            'providerIcon' => $providerIcon,
            'providerGraphic' => $providerGraphic,
            'model' => $model
        ];
        return $params;
    }



}
