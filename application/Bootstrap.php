<?php
/**
 * @name Bootstrap
 * @author wyf
 * @desc 所有在Bootstrap类中, 以_init开头的方法, 都会被Yaf调用,
 * @see http://www.php.net/manual/en/class.yaf-bootstrap-abstract.php
 * 这些方法, 都接受一个参数:Yaf_Dispatcher $dispatcher
 * 调用的次序, 和申明的次序相同
 */
use Wyf\Smarty\Adapter;
use Wyf\Model\Admin\AdminMenuModel;

class Bootstrap extends Yaf\Bootstrap_Abstract {
    private $config;

    /**
     * 初始化错误,要放在最前面
     */
    public function _initErrors()
    {
        //如果为开发环境,打开所有错误提示
        if (YAF\ENVIRON === 'develop') {
            error_reporting(E_ERROR | E_PARSE);//使用error_reporting来定义哪些级别错误可以触发//E_ERROR | E_WARNING | E_PARSE
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
        }
    }

    /**
     * 加载vendor下的文件
     */
    public function _initLoader()
    {
        Yaf\Loader::import(APPLICATION_PATH . '/vendor/autoload.php');
        Yaf\Loader::getInstance()->registerLocalNamespace("Wyf");
    }

    public function _initConfig(Yaf\Dispatcher $dispatcher) {
		//把配置保存起来
        $this->config = Yaf\Application::app()->getConfig();
		Yaf\Registry::set('config', $this->config);
        $dispatcher->autoRender(false);
	}


    public function _initSmarty(Yaf\Dispatcher $dispatcher){
        $smarty = new Adapter(null , Yaf\Application::app()->getConfig()->smarty);
        $dispatcher->setView($smarty);
    }


    /**
     * 日志
     */
    public function _initLogger()
    {
        //SocketLog
        if (YAF\ENVIRON === 'develop') {
            if ($this->config->seaslog->enable) {
                \SeasLog::setLogger('yaf');
            }
        }
    }




    /**
      * Author: wyf
      * Host: http://t5.test.chemm.com
      * Date: 2020-12-08 14:54:57
      * Description: 公告函数入口
      */
    public function _initCommon(){
        Yaf\Loader::import("Common/functions.php");
    }


	public function _initRoute(Yaf\Dispatcher $dispatcher) {
		//在这里注册自己的路由协议,默认使用简单路由
//        $router = Yaf_Dispatcher::getInstance()->getRouter();
//        $route = new Yaf_Route_Simple("m", "c", "a");
//        $router->addRoute('myRoute',$route);
        $router = $dispatcher->getRouter();
        $route = new Yaf\Route\Rewrite(
            'api/:controller/:action',
            array(
                'controller' => ':controller',
                'action' => ':action',
            )
        );
        $router->addRoute('api', $route);

    }
}
