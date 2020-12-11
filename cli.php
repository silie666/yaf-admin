<?php

define('APPLICATION_PATH', dirname(__FILE__));

$application = new Yaf_Application( APPLICATION_PATH . "/conf/application.ini");
$application->bootstrap();
$application->getDispatcher()->dispatch(new Yaf_Request_Simple());
$application->run();
?>