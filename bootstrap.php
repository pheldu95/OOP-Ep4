<?php

$configuration = array(
    'db_dsn'  => 'mysql:host=localhost;dbname=oo_battle',
    'db_user' => 'root',
    'db_pass' => null,
);

//autoloader. will only load BattleManager if we call for it. where as using require statement would load it no matter what even if we aren't using it. makes app faster
spl_autoload_register(function($className){
    //uses the namespace to find the file. since the namespace is the same as the folder it's in
    $path = __DIR__.'/lib/'.str_replace('\\', '/', $className).'.php';

    if(file_exists($path)){
        require $path;
    }
});