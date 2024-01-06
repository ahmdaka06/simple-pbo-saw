<?php

require_once 'config.php';

if (getenv('DEVELOPMENT') == 'true') { // init production true or false
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    error_reporting(E_ALL);
}

if (getenv('INSTALLED') == 'false') { // check if installed
    exit(redirect(base_url('/not-installed')));
}

require_once 'library/class/db.class.php';

$db = new DB($config['db']);
