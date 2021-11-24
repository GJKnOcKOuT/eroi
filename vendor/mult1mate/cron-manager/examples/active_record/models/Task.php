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

use ActiveRecord\Model;
use mult1mate\crontab\DbHelper;
use mult1mate\crontab\TaskInterface;
use mult1mate\crontab\TaskRunInterface;

/**
 * @author mult1mate
 * @property int $task_id
 * @property string $time
 * @property string $command
 * @property string $status
 * @property string $comment
 * @property array $taskruns
 * @property \ActiveRecord\DateTime $ts
 * @property \ActiveRecord\DateTime $ts_updated
 */
class Task extends Model implements TaskInterface
{
    static public $has_many = array(
        array('taskruns', 'class_name' => 'TaskRun')
    );

    public static function taskGet($task_id)
    {
        return self::find($task_id);
    }

    public static function getList()
    {
        return self::find('all', array(
            'conditions' => array('status in (?)', array(TaskInterface::TASK_STATUS_ACTIVE, TaskInterface::TASK_STATUS_INACTIVE)),
            'order' => 'status, task_id desc',
        ));
    }

    public static function getAll()
    {
        return self::all();
    }

    public static function getReport($date_begin, $date_end)
    {
        return self::query(DbHelper::getReportSql(), array($date_begin, $date_end))->fetchAll();
    }

    public function taskDelete()
    {
        return $this->delete();
    }

    public function taskSave()
    {
        return $this->save();
    }

    public static function createNew()
    {
        return new self();
    }

    /**
     * @return TaskRunInterface
     */
    public function createTaskRun()
    {
        return new TaskRun();
    }

    /**
     * @return mixed
     */
    public function getTaskId()
    {
        return $this->task_id;
    }

    /**
     * @return mixed
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param mixed $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * @param mixed $command
     */
    public function setCommand($command)
    {
        $this->command = $command;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getTs()
    {
        return $this->ts;
    }

    /**
     * @param mixed $ts
     */
    public function setTs($ts)
    {
        $this->ts = $ts;
    }

    /**
     * @return mixed
     */
    public function getTsUpdated()
    {
        return $this->ts_updated;
    }

    /**
     * @param mixed $ts
     */
    public function setTsUpdated($ts)
    {
        $this->ts_updated = $ts;
    }
}
