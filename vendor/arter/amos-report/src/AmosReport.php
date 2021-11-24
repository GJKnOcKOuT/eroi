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
 * @package    arter\amos\report
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\report;

use arter\amos\core\module\AmosModule;
use arter\amos\core\module\ModuleInterface;
use arter\amos\notificationmanager\models\Notification;
use arter\amos\notificationmanager\models\NotificationsRead;
use arter\amos\notificationmanager\models\NotificationChannels;
use arter\amos\report\models\Report;
use Yii;
use yii\db\ActiveQuery;

/**
 * Class AmosReport
 * @package arter\amos\report
 */
class AmosReport extends AmosModule implements ModuleInterface
{
    public static $CONFIG_FOLDER = 'config';

    /**
     * @var string|boolean the layout that should be applied for views within this module. This refers to a view name
     * relative to [[layoutPath]]. If this is not set, it means the layout value of the [[module|parent module]]
     * will be taken. If this is false, layout will be disabled within this module.
     */
    public $layout              = 'main';
    public $name                = 'Report';
    public $controllerNamespace = 'arter\amos\report\controllers';

    /**
     * @var array
     */
    public $modelsEnabled = [
    ];

    /**
     * This is the html used to render the subject of the e-mail.
     * @var string
     */
    public $htmlMailSubject = '@vendor/arter/amos-report/src/views/report/email/report_notification_subject';

    /**
     * This is the html used to render the message of the e-mail.
     * @var string
     */
    public $htmlMailContent = '@vendor/arter/amos-report/src/views/report/email/report_notification';

    public static function getModuleName()
    {
        return "report";
    }

    public function init()
    {
        parent::init();

        \Yii::setAlias('@arter/amos/'.static::getModuleName().'/controllers', __DIR__.'/controllers');
        // initialize the module with the configuration loaded from config.php
        Yii::configure($this, require(__DIR__.DIRECTORY_SEPARATOR.self::$CONFIG_FOLDER.DIRECTORY_SEPARATOR.'config.php'));
    }

    public function getWidgetIcons()
    {
        return [
        ];
    }

    public function getWidgetGraphics()
    {
        return [
        ];
    }

    /**
     * Get default model classes
     */
    protected function getDefaultModels()
    {
        return [
            'Report' => __NAMESPACE__.'\\'.'models\Report',
            'ReportType' => __NAMESPACE__.'\\'.'models\ReportType',
            'ReportSearch' => __NAMESPACE__.'\\'.'models\ReportSearch',
        ];
    }

    /**
     * query for all unread reports sent to user
     *
     * @param null|integer $userId - if null logged user is considered
     * @return ActiveQuery $query of unread report sent to $userId
     *
     */
    public function getOwnUnreadReports($userId = null)
    {

        if (empty($userId)) {
            $userId = \Yii::$app->user->id;
        }
        $notificationTable     = Notification::tableName();
        $notificationReadTable = NotificationsRead::tableName();
        $query                 = Report::find()->andWhere('report.creator_id = '.$userId.' OR report.validator_id = '.$userId);
        $query->leftJoin($notificationTable,
            $notificationTable.".class_name = '".Report::className()."' AND ".$notificationTable.".content_id = report.id AND notification.channels = '".NotificationChannels::CHANNEL_READ."'");
        $query->leftJoin($notificationReadTable,
            $notificationReadTable.'.notification_id = '.$notificationTable.'.id AND notificationread.user_id = '.$userId);
        $query->andWhere('report.deleted_at is NULL');
        $query->andWhere($notificationReadTable.'.user_id is null OR '.$notificationReadTable.'.user_id <> '.$userId);
        return $query;
    }
}