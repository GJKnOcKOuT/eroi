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

/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\HangoutsChat;

class DeprecatedEvent extends \Google\Model
{
  protected $actionType = FormAction::class;
  protected $actionDataType = '';
  public $configCompleteRedirectUrl;
  public $eventTime;
  protected $messageType = Message::class;
  protected $messageDataType = '';
  protected $spaceType = Space::class;
  protected $spaceDataType = '';
  public $threadKey;
  public $token;
  public $type;
  protected $userType = User::class;
  protected $userDataType = '';

  /**
   * @param FormAction
   */
  public function setAction(FormAction $action)
  {
    $this->action = $action;
  }
  /**
   * @return FormAction
   */
  public function getAction()
  {
    return $this->action;
  }
  public function setConfigCompleteRedirectUrl($configCompleteRedirectUrl)
  {
    $this->configCompleteRedirectUrl = $configCompleteRedirectUrl;
  }
  public function getConfigCompleteRedirectUrl()
  {
    return $this->configCompleteRedirectUrl;
  }
  public function setEventTime($eventTime)
  {
    $this->eventTime = $eventTime;
  }
  public function getEventTime()
  {
    return $this->eventTime;
  }
  /**
   * @param Message
   */
  public function setMessage(Message $message)
  {
    $this->message = $message;
  }
  /**
   * @return Message
   */
  public function getMessage()
  {
    return $this->message;
  }
  /**
   * @param Space
   */
  public function setSpace(Space $space)
  {
    $this->space = $space;
  }
  /**
   * @return Space
   */
  public function getSpace()
  {
    return $this->space;
  }
  public function setThreadKey($threadKey)
  {
    $this->threadKey = $threadKey;
  }
  public function getThreadKey()
  {
    return $this->threadKey;
  }
  public function setToken($token)
  {
    $this->token = $token;
  }
  public function getToken()
  {
    return $this->token;
  }
  public function setType($type)
  {
    $this->type = $type;
  }
  public function getType()
  {
    return $this->type;
  }
  /**
   * @param User
   */
  public function setUser(User $user)
  {
    $this->user = $user;
  }
  /**
   * @return User
   */
  public function getUser()
  {
    return $this->user;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(DeprecatedEvent::class, 'Google_Service_HangoutsChat_DeprecatedEvent');
