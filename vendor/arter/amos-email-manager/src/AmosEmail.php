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
 * @package    arter\amos\email
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\emailmanager;

use arter\amos\core\module\AmosModule;
use arter\amos\emailmanager\base\AmosEmailManager;
use arter\amos\emailmanager\models\EmailView;
use yii\base\BootstrapInterface;
use yii\console\Application;
use yii\log\Logger;
use Yii;
use yii\base\Exception;

class AmosEmail extends AmosModule implements BootstrapInterface
{

    public static $moduleId = 'email';
    public $name = 'Email manager';

    /**
     * @var string Template type, can be "db" or "php".
     */
    public $templateType = "php";
    public $templatePath = "/emails/";

    /**
     * @var string The default layout to use for template emails.
     */
    public $defaultTemplate = "layout_default";
    public $defaultLayout = "layout_fancy";
    public $controllerNamespace = 'arter\amos\emailmanager\controllers';
    private $emailManager = null;


    /**
     *
     * @return string
     */
    public static function getModuleName()
    {
        return self::$moduleId;
    }

    /**
     *
     */
    public function init()
    {
        parent::init();
        \Yii::setAlias('@email', __DIR__ . '/');
        \Yii::setAlias('@arter/amos/emailmanager/commands', __DIR__ . '/commands/');
        // initialize the module with the configuration loaded from config.php
        \Yii::configure($this, require(__DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php'));
        if (Yii::$app instanceof \yii\web\Application) {
            $this->controllerMap = array(
                'spool' => 'arter\amos\emailmanager\controllers\EmailSpoolController',
                'template' => 'arter\amos\emailmanager\controllers\EmailTemplateController',
            );
        }
        $this->initializeEmailManager();
    }

    /**
     *
     */
    private function initializeEmailManager()
    {
        $this->emailManager = new AmosEmailManager();
        $this->emailManager->defaultLayout = $this->defaultLayout;
        $this->emailManager->defaultTemplate = $this->defaultTemplate;
        $this->emailManager->templateType = $this->templateType;
        $this->emailManager->templatePath = $this->templatePath;
    }

    /**
     *
     * @param Application $app
     */
    public function bootstrap($app)
    {
        if ($app instanceof Application) {
            $this->controllerNamespace = 'arter\amos\emailmanager\commands';
        }
    }

    /**
     *
     * @see
     */
    protected function getDefaultModels()
    {
        return [
            'EmailSpool' => __NAMESPACE__ . '\\' . 'models\EmailSpool',
            'EmailTemplate' => __NAMESPACE__ . '\\' . 'models\EmailTemplate',
        ];
    }

    /**
     *
     * @see
     */
    public function getWidgetGraphics()
    {
        return [];
    }

    /**
     *
     * @see
     */
    public function getWidgetIcons()
    {
        return [];
    }

    /**
     * Sends email message queue using default transport
     *
     * @param string $from format accepted:
     *
     *   1) 'example@example.com'
     *   2) 'example@example.com alias' the method considers the email address up to the first space, everything that follows is considered alias.
     *
     * @param string $to
     * @param string $subject
     * @param string $text
     * @param integer $priority
     * @param array $files
     * @param array $bcc
     */
    public function queue($from, $to, $subject, $text, $files = [], $bcc = [], $params = [], $priority = 0)
    {
        $retValue = false;
        try {
            if ($this->emailManager) {
                $this->emailManager->defaultLayout = $this->defaultLayout;
                $this->emailManager->defaultTemplate = $this->defaultTemplate;
                $retValue = $this->emailManager->queue($from, $to, $subject, $text, $files, $bcc, $params, $priority);
            }
        } catch (Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $retValue;
    }

    /**
     * Sends email message immediately using default transport
     *
     * @param string $from format accepted:
     *
     *   1) 'example@example.com'
     *   2) 'example@example.com alias' the method considers the email address up to the first space, everything that follows is considered alias.
     *
     * @param string $to
     * @param string $subject
     * @param string $text
     * @param array $files
     * @param array $bcc
     * @return bool
     */
    public function send($from, $to, $subject, $text, $files = [], $bcc = [], $params = [], $save_in_queue = true, $cc = [], $replyTo = [])
    {
        $retValue = false;
        try {
            if ($this->emailManager) {
                $this->emailManager->defaultLayout = $this->defaultLayout;
                $this->emailManager->defaultTemplate = $this->defaultTemplate;
                $retValue = $this->emailManager->send($from, $to, $subject, $text, $files, $bcc,$params,$save_in_queue, $cc, $replyTo);
            }
        } catch (Exception $ex)
        {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $retValue;
    }

    /**
     *
     * @param integer $loopLimit
     * @return integer
     */
    public function spool($loopLimit = 1000)
    {
        $retValue = 0;
        try {
            if ($this->emailManager) {
                $retValue = $this->emailManager->spool($loopLimit);
            }
        } catch (Exception $ex) {
            Yii::getLogger()->log($ex->getMessage(), Logger::LEVEL_ERROR);
        }
        return $retValue;
    }

    public function render($module, $view, $params = [])
    {
        $emailView = EmailView::find()->andWhere(['module' => $module, 'view' => $view])->one();

        if (!$emailView || !$emailView->id) {
            $emailView = new EmailView();
            $emailView->module = $module;
            $emailView->content = "{original}";
            $emailView->view = $view;
            $emailView->save(false);
        }

        $paramsMap = [];
        foreach ($params as $name => $param) {
            $type = gettype($param);

            switch ($type) {
                case 'boolean':
                case 'integer':
                case 'double':
                case 'string':
                    {
                        $paramsMap[$name] = $type;
                    }
                    break;
                case 'array':
                    {
                        $paramsMap[$name] = array_keys($param);
                    }
                    break;
                case 'object':
                    {
                        $paramsMap[$name] = get_class($param);
                    }
                    break;
            }
        }

        $emailView->params = json_encode($paramsMap);
        $emailView->save(false);

        $message = $emailView->content;
        $placeholders = [];

        foreach ((array) $params as $name => $value) {
            $placeholders['{' . $name . '}'] = $value;
        }

        return ($placeholders === []) ? $message : strtr($message, $placeholders);
    }

}
