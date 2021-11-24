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


namespace arter\expo;

class Message
{
    private $title;
    private $body;
    private $badge;
    private $icon;
    private $color;
    private $sound;
    private $clickAction;
    private $tag;
    private $data;
    private $priority = 'default';
    private $subtitle;
    private $channelId;

    public function __construct($title, $body)
    {
        $this->title = $title;
        $this->body  = $body;
    }

    /**
     * android only: notification title (also works for ios watches)
     *
     * @param string $title
     *
     * @return arter\expo\Message
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * android/ios: the body text is the main content of the notification
     *
     * @param string $body
     *
     * @return arter\expo\Message
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * iOS only: will add smal red bubbles indicating the number of notifications to your apps icon
     *
     * @param integer $badge
     *
     * @return arter\expo\Message
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
        return $this;
    }

    /**
     * android only: set the name of your drawable resource as string
     *
     * @param string $icon the drawable name without .xml
     *
     * @return arter\expo\Message
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * android only: background color of the notification icon when showing details on notifications
     *
     * @param string $color in #rrggbb format
     *
     * @return arter\expo\Message
     */
    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * android/ios: what should happen upon notification click. when empty on android the default activity
     * will be launched passing any payload to an intent.
     *
     * @param string $actionName on android: intent name, on ios: category in apns payload
     *
     * @return arter\expo\Message
     */
    public function setClickAction($actionName)
    {
        $this->clickAction = $actionName;
        return $this;
    }

    /**
     * android only: when set notification will replace prior notifications from the same app with the same
     * tag.
     *
     * @param string $tag
     *
     * @return arter\expo\Message
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
        return $this;
    }

    /**
     * android/ios: can be default or a filename of a sound resource bundled in the app.
     * @see https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support
     *
     * @param string $sound a sounds filename
     *
     * @return arter\expo\Message
     */
    public function setSound($sound)
    {
        $this->sound = $sound;
        return $this;
    }

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    /**
     * 
     * @return array
     */
    public function buildMessage()
    {
        $jsonData = array();
        if ($this->title) {
            $jsonData['title'] = $this->title;
        }
        $jsonData['body'] = $this->body;
        if ($this->badge) {
            $jsonData['badge'] = $this->badge;
        }
        if ($this->icon) {
            $jsonData['icon'] = $this->icon;
        }
        if ($this->clickAction) {
            $jsonData['click_action'] = $this->clickAction;
        }
        if ($this->sound) {
            $jsonData['sound'] = $this->sound;
        }
        if ($this->color) {
            $jsonData['color'] = $this->color;
        }
        if ($this->tag) {
            $jsonData['tag'] = $this->tag;
        }
        if ($this->data) {
            $jsonData['data'] = $this->data;
        }
        if ($this->priority) {
            $jsonData['priority'] = $this->priority;
        }
        if ($this->subtitle) {
            $jsonData['subtitle'] = $this->subtitle;
        }
        if ($this->channelId) {
            $jsonData['channelId'] = $this->channelId;
        }
        return $jsonData;
    }

    /**
     *
     * @return string
     */
    public function getPriority()
    {
        return $this->priority;
    }

    /**
     *
     * @param string $priority
     */
    public function setPriority($priority)
    {
        $this->priority = $priority;
    }

    /**
     *
     * @return string
     */
    public function getSubtitle()
    {
        return $this->subtitle;
    }

    /**
     *
     * @param string $subtitle
     */
    public function setSubtitle($subtitle)
    {
        $this->subtitle = $subtitle;
    }

    public function getChannelId()
    {
        return $this->channelId;
    }

    public function setChannelId($channelId)
    {
        $this->channelId = $channelId;
    }
}