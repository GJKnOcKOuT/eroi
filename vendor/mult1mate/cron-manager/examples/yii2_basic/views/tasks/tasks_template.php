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
 * @var $content
 */
$menu = array(
    'index' => 'Tasks list',
    'task-edit' => 'Add new/edit task',
    'task-log' => 'Logs',
    'export' => 'Import/Export',
    'tasks-report' => 'Report',
);
?>
<script src="manager_actions.js"></script>
<div class="col-lg-10">
    <h2>Cron tasks manager</h2>

    <ul class="nav nav-tabs">
        <?php foreach ($menu as $m => $text):
            $class = (isset($_GET['m']) && ($_GET['m'] == $m)) ? 'active' : '';
            ?>
            <li class="<?= $class ?>"><a href="?r=tasks/<?= $m ?>"><?= $text ?></a></li>
        <?php endforeach; ?>
    </ul>
    <br>
</div>
