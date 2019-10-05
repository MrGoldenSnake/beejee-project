<?php

ini_set('display_errors',1);
error_reporting(E_ALL ^E_NOTICE ^E_WARNING);

// подключаем файлы ядра
require_once 'app/core/config.php';
require_once 'app/core/session.php';
require_once 'app/core/db.php';
require_once 'app/core/view.php';
require_once 'app/core/controller.php';
require_once 'app/core/router.php';

Session::init();
Router::start();

function dump($k) {echo '<pre>';var_dump($k);echo '</pre>';}

function screen($k)
{
	return htmlentities($k,ENT_QUOTES);
}
