<?php
function __autoload($className)
{

    //List all class directories in the array
    $array_paths = array(
        '/models/',
        '/components/'
    );

    foreach ($array_paths as $path){
        $path = ROOT . $path . $className . '.php';
        if(is_file($path)){
            include_once $path;
        }
    }
}

?>