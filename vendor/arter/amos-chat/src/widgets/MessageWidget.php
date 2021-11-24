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
 * @package    arter\amos\chat
 * @category   CategoryName
 * @author     Elite Division S.r.l.
 */

namespace arter\amos\chat\widgets;

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\widgets\ListView;

/**
 * Class MessageWidget
 * @package arter\amos\chat\widgets
 */
class MessageWidget extends ListView
{
    /**
     * @var string
     */
    public static $MESSAGE_TEMPLATE = '@vendor/arter/amos-chat/src/widgets/views/message.php';

    /**
     * @var array
     */
    public $user;

    /**
     * @var array
     */
    public $contact;

    /**
     * @var
     */
    public $formView;

    /**
     * @var array
     */
    public $formParams = [];

    /**
     * @var array
     */
    public $clientOptions = [];

    /**
     * @var array
     */
    public $liveOptions = [];

    /**
     * @var
     */
    private $tag;

    /**
     * @inheritdoc
     */
    public function init()
    {
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }
        if (!isset($this->clientOptions['itemCssClass'])) {
            $this->clientOptions['itemCssClass'] = 'msg';
        }
        $this->tag = ArrayHelper::remove($this->options, 'tag', 'div');
        echo Html::beginTag($this->tag, $this->options);
    }

    /**
     * @param bool $autoGenerate
     * @return string
     */
    public function getId($autoGenerate = true)
    {
        $users = [$this->user['id'], $this->contact['id']];
        sort($users);
        return md5(implode('&', $users));
    }

    /**
     * @inheritdoc
     */
    public function run()
    {
        $this->registerJs();
        echo Html::endTag($this->tag);
    }

    /**
     *
     */
    public function registerJs()
    {
        $id = $this->options['id'];
        $options = Json::htmlEncode($this->clientOptions);
        $user = Json::htmlEncode($this->user);
        $contact = Json::htmlEncode($this->contact);
        $view = $this->getView();
        if (!\Yii::$app->getRequest()->isPjax) {
            $view->registerJs("jQuery('#$id').amosChatMessages($user,$contact,$options);");
        }
    }

    /**
     * @param string $name
     * @return bool|mixed|string
     */
    public function renderSection($name)
    {
        switch ($name) {
            case '{items}':
                return $this->renderItems();
            case '{form}':
                return $this->renderForm();
            default:
                return false;
        }
    }

    /**
     * @return string
     */
    public function renderItems()
    {
        $models = $this->dataProvider->getModels();
        $keys = $this->dataProvider->getKeys();
        $rows = [];
        foreach (array_reverse($models, true) as $index => $model) {
            $rows[] = $this->renderItem($model, $keys[$index], $index);
        }
        return implode($this->separator, $rows);
    }

    /**
     * @param mixed $model
     * @param mixed $key
     * @param int $index
     * @return mixed|string
     */
    public function renderItem($model, $key, $index)
    {
        if ($this->itemView === null) {
            $content = $key;
        } elseif (is_string($this->itemView)) {
            $content = $this->getView()->renderFile($this->itemView, array_merge([
                'model' => $model,
                'key' => $key,
                'index' => $index,
                'user' => $this->user,
                'sender' => $model['senderId'] == $this->user['id'] ? $this->user : $this->contact,
                'settings' => $this->clientOptions,
                'msgOwnerClass' => $model['senderId'] == $this->user['id'] ? 'mine' : 'others'
            ], $this->viewParams));
        } else {
            $content = call_user_func($this->itemView, $model, $key, $index, $this);
        }
        return $content;
    }

    /**
     * @return mixed|string
     */
    public function renderForm()
    {
        if (is_string($this->formView)) {
            $content = $this->getView()->renderFile($this->formView, array_merge([
                'widget' => $this,
            ], $this->formParams));
        } else {
            $content = call_user_func($this->formView, $this);
        }
        return $content;
    }
}
