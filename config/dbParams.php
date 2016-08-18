<?php

if($_SERVER['REMOTE_ADDR'] == '127.0.0.1') {
    return array(
        'host' => 'localhost',
        'dbname' => 'photoApplication',
        'user' => 'root',
        'password' => "",

    );
} else {
    return array(
        'host' => 'localhost',
        'dbname' => 'photoApplication',
        'user' => 'root',
        'password' => '$ss8BS94B#2',

    );
}
?>