<?php
defined('BASEPATH') or exit('No direct script access allowed');
$active_group = 'default';
$query_builder = true;
$db['default'] = [
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'my_iphone',
    'dbdriver' => 'mysqli',

    // 'hostname' => 'localhost',
    // 'username' => 'u197809344_fgambino',
    // 'password' => 'Jamboree0381$$',
    // 'database' => 'u197809344_myiphone',
    // 'dbdriver' => 'mysqli',

    'dbprefix' => '',
    'pconnect' => false,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => false,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt' => false,
    'compress' => false,
    'stricton' => false,
    'failover' => [],
    'save_queries' => true
];
