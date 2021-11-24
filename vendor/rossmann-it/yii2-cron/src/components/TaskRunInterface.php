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

namespace rossmann\cron\components;

/**
 * Interface TaskRunInterface
 * Common interface to handle task runs
 * @author  mult1mate
 * @since 20.12.2015
 */
interface TaskRunInterface
{
    const RUN_STATUS_STARTED   = 'started';
    const RUN_STATUS_COMPLETED = 'completed';
    const RUN_STATUS_ERROR     = 'error';

    /**
     * Saves the task run
     * @return mixed
     */
    public function saveTaskRun();

    /**
     * @return int
     */
    public function getId();

    /**
     * @return int
     */
    public function getTaskId();

    /**
     * @param int $taskId
     */
    public function setTaskId($taskId);

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
     * @param string $executionTime
     */
    public function setExecutionTime($executionTime);

    /**
     * @return string
     */
    public function getTs();

    /**
     * @param string $timestamp
     */
    public function setTs($timestamp);

    /**
     * @return string
     */
    public function getOutput();

    /**
     * @param string $output
     */
    public function setOutput($output);
}
