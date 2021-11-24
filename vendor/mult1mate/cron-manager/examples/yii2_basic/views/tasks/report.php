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
 * @var string $date_begin
 * @var string $date_end
 * @var array $report
 */
echo $this->render('tasks_template');
$this->title = 'Task Manager - Report';
?>
<form class="form-inline" action="">
    <div class="form-group">
        <label for="date_begin" class="control-label">Date begin</label>
        <input type="date" value="<?= $date_begin ?>" name="date_begin" id="date_begin" class="form-control">
    </div>
    <div class="form-group">
        <label for="date_end" class="control-label">Date end</label>
        <input type="date" value="<?= $date_end ?>" name="date_end" id="date_end" class="form-control">
    </div>
    <div class="form-group">
        <input type="hidden" value="tasks-report" name="r">
        <input type="submit" value="Update" class="btn btn-primary">
    </div>

</form>
<table class="table">
    <tr>
        <th>Task</th>
        <th>Avg. time</th>
        <th>Success</th>
        <th>Started</th>
        <th>Error</th>
        <th>All</th>
    </tr>
    <?php foreach ($report as $r): ?>
        <tr>
            <td><?= $r['command'] ?></td>
            <td><?= $r['time_avg'] ?></td>
            <td><?= $r['completed'] ?></td>
            <td><?= $r['started'] ?></td>
            <td><?= $r['error'] ?></td>
            <th><?= $r['runs'] ?></th>
        </tr>
    <?php endforeach; ?>
</table>
