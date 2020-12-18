<?php

namespace myxland\uploader\library;

use think\console\Command;
use think\console\Input;
use think\console\Output;
use think\facade\Env;

class SendConfig extends Command
{
    public function configure()
    {
        $this->setName('uploader:config')->setDescription('send config to tp folder');
    }

    public function execute(Input $input, Output $output)
    {
        //获取默认配置文件
        $content = file_get_contents(Env::get('root_path') . 'vendor/' . 'myxland/think-uploader/src/config.php');

        $configPath = Env::get('root_path') . 'config/';
        $configFile = $configPath . 'uploader.php';

        //判断目录是否存在
        if (! file_exists($configPath)) {
            mkdir($configPath, 0755, true);
        }

        //判断文件是否存在
        if (is_file($configFile)) {
            throw new \InvalidArgumentException(sprintf('The config file "%s" already exists', $configFile));
        }

        if (false === file_put_contents($configFile, $content)) {
            throw new \RuntimeException(sprintf('The config file "%s" could not be written to "%s"', $configFile, $configPath));
        }

        $output->writeln('create uploader config ok');
    }
}