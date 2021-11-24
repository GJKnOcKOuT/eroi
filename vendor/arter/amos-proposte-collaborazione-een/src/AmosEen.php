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


namespace arter\amos\een;

use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use yii\console\Application;
use yii\helpers\FileHelper;
use arter\amos\core\interfaces\SearchModuleInterface;

/**
 * Class AmosEen
 * @package arter\amos\een
 */
class AmosEen extends AmosModule implements ModuleInterface, SearchModuleInterface
{
    const MAX_LAST_PARTNERSHIP_ON_DASHBOARD = 3;

    /**
     * @inheritdoc
     */
    public $controllerNamespace       = 'arter\amos\een\controllers';
    public $name                      = 'een';
    public $wsdl                      = null; //'http://een.ec.europa.eu/tools/services/podv6/QueryService.svc?wsdl';
    public $findAllAccessPoint        = null; //'GetProfilesSOAP';
    public $findAllAccessPointRequest = null;
    public $mailToSendInterest        = null;

    /**
     *
     * @var array
     */
    public $tagsEenEnabled = ['makets', 'tecnologies', 'naces'];

    /**
     *
     * @var array
     */
    public $book_ids       = ['markets' => 1,
        'tecnologies' => 16,
        'naces' => 4];

    /**
     * Root id for the platform TAG
     * @var integer
     */
    public $root_id = 3;

    /**
     *
     * @var type
     */
    public $enableCreateEen = true;

    /**
     *
     * @var boolean
     */
    public $enableConversionTag = false;

    /**
     * @var array
     */
    public $viewPathEmailContentSubtitle = [
        'arter\amos\een\models\EenPartnershipProposal' => '@vendor/arter/amos-proposte-collaborazione-een/src/views/email/notify_email_content'
    ];

    /**
     * @var array
     */
    public $viewPathEmailSummary        = [
        'arter\amos\een\models\EenPartnershipProposal' => '@vendor/arter/amos-proposte-collaborazione-een/src/views/email/notify_summary'
    ];
    public $viewPathEmailSummaryNetwork = [];

    /**
     * @return string
     */
    public static function getModuleName()
    {
        return 'een';
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        \Yii::setAlias('@arter/amos/'.static::getModuleName().'/commands/controllers',
            __DIR__.'/commands/controllers');
        // custom initialization code goes here
        \Yii::configure($this, require(__DIR__.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php'));

        if (\Yii::$app instanceof Application) {
            $this->controllerNamespace = 'arter\amos\een\commands\controllers';
            if (!defined('LOG_DIR')) {
                define('LOG_DIR',
                    \Yii::getAlias("@runtime").DIRECTORY_SEPARATOR."een".DIRECTORY_SEPARATOR."calls".DIRECTORY_SEPARATOR);
            }
            FileHelper::createDirectory(LOG_DIR, 0777);
        }
    }

    /**
     * @inheritdoc
     */
    public function getWidgetGraphics()
    {
        return null;
    }

    /**
     * @inheritdoc
     */
    public function getWidgetIcons()
    {
        return [
            \arter\amos\een\widgets\icons\WidgetIconEenDashboard::className(),
            \arter\amos\een\widgets\icons\WidgetIconEen::className(),
            \arter\amos\een\widgets\icons\WidgetIconEenAll::className(),
            \arter\amos\een\widgets\icons\WidgetIconEenArchived::className()
        ];
    }

    /**
     * @inheritdoc
     */
    protected function getDefaultModels()
    {
         return [
            'EenPartnershipProposal' => __NAMESPACE__.'\\'.'models\EenPartnershipProposal',
            'EenExprOfInterest' => __NAMESPACE__.'\\'.'models\EenExprOfInterest',
            'EenNetworkNode' => __NAMESPACE__.'\\'.'models\EenNetworkNode',
            'EenStaff' => __NAMESPACE__.'\\'.'models\EenStaff',
            'EenTagEen' => __NAMESPACE__.'\\'.'models\EenTagEen',
            'EenTagS3TagEenMm' => __NAMESPACE__.'\\'.'models\EenTagS3TagEenMm',
            'InfoReqModel' => __NAMESPACE__.'\\'.'models\InfoReqModel',
            'ProposalForm' => __NAMESPACE__.'\\'.'models\ProposalForm',
            'EenExprOfInterestHistory' => __NAMESPACE__.'\\'.'models\EenExprOfInterestHistory',
            'EenExprOfInterestSearch' => __NAMESPACE__.'\\'.'models\search\EenExprOfInterestSearch',
            'EenPartnershipProposalSearch' => __NAMESPACE__.'\\'.'models\search\EenPartnershipProposalSearch',
            'EenTagEenSearch' => __NAMESPACE__.'\\'.'models\search\EenTagEenSearch',
            'EenTagS3TagEenMmSearch' => __NAMESPACE__.'\\'.'models\search\EenTagS3TagEenMmSearch',
        ];
    }

    /**
     * @inheritdoc
     */
    public static function getModelSearchClassName()
    {
        return AmosEen::instance()->model('NewsSearch');
    }

    /**
     * @inheritdoc
     */
    public static function getModuleIconName()
    {
        return 'proposte-een';
    }
}