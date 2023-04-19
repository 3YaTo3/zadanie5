<?php
$config = [
    'db_host' => 'localhost',
    'db_username' => 'username',
    'db_password' => 'password',
    'db_name' => 'dbname',
    'session_name' => 'my_session',
    'session_expire' => 3600,
];

define('DB_HOST', $config['db_host']);
define('DB_USERNAME', $config['db_username']);
define('DB_PASSWORD', $config['db_password']);
define('DB_NAME', $config['db_name']);
define('SESSION_NAME', $config['session_name']);
define('SESSION_EXPIRE', $config['session_expire']);
?>