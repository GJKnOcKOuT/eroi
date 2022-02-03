<?php

/* @var $this yii\web\View */

$this->title = 'SUPERCraft';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent">
        <h1 class="display-4">Benvenuto!</h1>

        <p><a class="btn btn-lg btn-success" href="/supercaft/index">Visualizza i processi aziendali!</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Crea</h2>

                <p>Qui puoi creare un nuovo processo aziendale</p>

                <p><a class="btn btn-outline-secondary" href="/supercaft/pa/create">Crea &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Ricerca</h2>

                <p>Qui puoi ricercare un processo aziendale</p>

                <p><a class="btn btn-outline-secondary" href="/supercaft/pa/index">Ricerca &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Documentazione</h2>

                <p>Vuoi rivedere la documentazione di Yii2?</p>

                <p><a class="btn btn-outline-secondary" href="http://www.yiiframework.com">Yii2 &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
