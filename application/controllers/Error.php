<?php
/**
 * @name ErrorController
 * @desc 错误控制器, 在发生未捕获的异常时刻被调用
 * @see http://www.php.net/manual/en/yaf-dispatcher.catchexception.php
 * @author Silie
 */
class ErrorController extends Yaf\Controller_Abstract {

	//从2.1开始, errorAction支持直接通过参数获取异常
	public function errorAction($exception) {
	//1. assign to view engine
	$context = array(
            'msg' => str_replace(['|',"\n"],'',$exception->getMessage() . ' ---file:'.$exception->getFile().' ---lines:'.$exception->getLine()),
            'level' => method_exists($exception,'getSeverity')?$exception->getSeverity():5,
            'model' => defined('MODULE_NAME') ? $this->_request->module:'',
            'controller' => defined('CONTROLLER_NAME') ? $this->_request->controller:'',
            'action' => defined('ACTION_NAME') ? $this->_request->action:'',
        );
        \SeasLog::log(SEASLOG_ERROR,'ERROR {msg} | {level} | {model} | {controller} | {action}',$context);
        echo "错误已经记录到SeasLog";
        return false;
		//5. render by Yaf
	}
}
