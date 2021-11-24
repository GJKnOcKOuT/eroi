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
 * @var array $runs
 */
echo $this->render('tasks_template');
$this->title = 'Task Manager - Run list';
?>
<table class="table table-bordered">
    <tr>
        <th>ID</th>
        <th>Task ID</th>
        <th>Command</th>
        <th>Status</th>
        <th>Time</th>
        <th>Started</th>
        <th></th>
    </tr>
    <?php foreach ($runs as $r):
        /**
         * @var \app\models\TaskRun $r
         */
        ?>
        <tr>
            <td><?= $r['task_run_id'] ?></td>
            <td><?= $r['task_id'] ?> </td>
            <td><?= $r['command'] ?></td>
            <td><?= $r['status'] ?></td>
            <td><?= $r['execution_time'] ?></td>
            <td><?= $r['ts'] ?></td>
            <td>
                <?php if (!empty($r['output'])): ?>
                    <a href="<?= $r['task_run_id'] ?>" data-toggle="modal" data-target="#output_modal"
                       class="show_output">Show output</a>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
<div class="modal fade" tabindex="-1" role="dialog" id="output_modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Task run output</h4>
            </div>
            <div class="modal-body">
                <pre id="output_container">Loading...</pre>
            </div>
        </div>
    </div>
</div>
