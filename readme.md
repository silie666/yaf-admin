# Yaf快速开发，个人学习Yaf项目
> 目前只完成了admin部分
> 大部分思路来源于：
>[thinkcmf](https://www.thinkcmf.com/)
>[yafcms](https://gitee.com/huoyongliang/yafcms)
>模板来源于[ok-admin](https://gitee.com/wudibo/ok-admin)

### 个人环境
> yaf，redis，SeasLog这些都可以通过[PECL](http://pecl.php.net/)下载

| 服务        | 版本  | 
| --------   | -----:  | 
| PHP      | 7.0.33   | 
| Mysql        |    8.0   | 
| Yaf        |    3.2.5   | 
| Redis        |   5.3.2   | 
| SeasLog        |    2.0.2    | 

### php.ini新增配置
    extension=redis.so
    extension=yaf.so
    extension=seaslog.so
    yaf.use_namespace=1
    yaf.environ=develop
    seaslog.default_basepath = '/data'
    seaslog.default_logger = default

### nginx配置
> 因为有两个入口文件，这里只写大致配置

#### admin.conf

    listen 80;
    server_name a.test.com;

    root /home/wyf/project/phptest/yaf/public;
    location / {
        index  index.php index.html index.htm;
        if (!-e $request_filename){
            rewrite  ^(.*)$  /index.php?s=/$1  last;
            break;
        }
    }


#### api.conf

    listen 80;
    server_name a.test.com;
    root /home/wyf/project/phptest/yaf/public;
    location / {
        index  api.php;
        if (!-e $request_filename){
            rewrite  ^(.*)$  /api.php?s=/$1  last;
            break;
        }
    }







