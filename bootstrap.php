<?php

$configuration = array(
    'db_dsn'  => 'mysql:host=localhost;dbname=oo_battle',
    'db_user' => 'root',
    'db_pass' => null,
);

//autoloader. will only load BattleManager if we call for it. where as using require statement would load it no matter what even if we aren't using it. makes app faster
//now we are using the composer autoloader.
require __DIR__.'/vendor/autoload.php';