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

namespace mult1mate\crontab;

/**
 * Interface TaskRunInterface
 * Common interface to handle task runs
 * @package mult1mate\crontab
 * @author mult1mate
 */
interface TaskRunInterface
{
    const RUN_STATUS_STARTED = 'started';
    const RUN_STATUS_COMPLETED = 'completed';
    const RUN_STATUS_ERROR = 'error';

    /**
     * Saves the task run
     * @return mixed
     */
    public function saveTaskRun();

    /**
     * @return int
     */
    public function getTaskRunId();

    /**
     * @return int
     */
    public function getTaskId();

    /**
     * @param int $task_id
     */
    public function setTaskId($task_id);

    /**
     * @return string
     */
    public function getStatus();

    /**
     * @param string $status
     */
    public function setStatus($status);

    /**
     * @return string
     */
    public function getExecutionTime();

    /**
     * @param string $execution_time
     */
    public function setExecutionTime($execution_time);

    /**
     * @return string
     */
    public function getTs();

    /**
     * @param string $ts
     */
    public function setTs($ts);

    /**
     * @return string
     */
    public function getOutput();

    /**
     * @param string $output
     */
    public function setOutput($output);
}
