<?php
header('content-type:text/html;charset=utf-8');
/* 定义这个常量是为了在application.ini中引用*/
define('PROJECT_PATH', dirname(__FILE__));
define('APPLICATION_PATH', PROJECT_PATH."/..");

$application = new Yaf\Application( APPLICATION_PATH ."/conf/api.ini");


$application->bootstrap()->run();


?>
