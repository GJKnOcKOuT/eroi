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


/**
 * @author mult1mate
 */
class BusinessModel extends CI_Model
{
    public function test()
    {
        $task = Task::findOne();
        /**
         * @var \mult1mate\crontab\TaskInterface $task
         */
        echo $task->getCommand();
        return true;
    }
}
