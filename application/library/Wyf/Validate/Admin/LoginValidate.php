<?php
namespace Wyf\Validate\Admin;

use think\Validate;

class LoginValidate extends Validate
{
    protected $rule =   [
        'username'  => 'require',
        'password'   => 'require',
        'captcha' => 'require|number',
    ];

    protected $scene = [
      'doLogin' =>  ['username','password','captcha']
    ];
}