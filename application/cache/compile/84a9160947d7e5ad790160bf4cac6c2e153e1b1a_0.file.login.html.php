<?php
/* Smarty version 3.1.36, created on 2021-06-01 11:45:08
  from '/files/php/yaf-admin/application/modules/Admin/views/public/login.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_60b5ad442cd571_17165890',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '84a9160947d7e5ad790160bf4cac6c2e153e1b1a' => 
    array (
      0 => '/files/php/yaf-admin/application/modules/Admin/views/public/login.html',
      1 => 1622450396,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b5ad442cd571_17165890 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en" class="page-fill">
<head>
    <meta charset="UTF-8">
    <title>小小后台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="keywords" content="xxwz 小小网站">
    <meta name="description" content="xxwz 个人练习后台">
    <link rel="shortcut icon" href="<?php echo __IMAGES__;?>
/favicon.ico" type="image/x-icon"/>
    <link rel="stylesheet" href="<?php echo __CSS__;?>
/oksub.css"/>
</head>
<body class="page-fill">
    <div class="page-fill" id="login">
        <form class="layui-form">
            <div class="login_face"><img src="<?php echo __IMAGES__;?>
/logo.png"></div>
            <div class="layui-form-item input-item">
                <label for="username">用户名</label>
                <input type="text" lay-verify="required" name="username" placeholder="请输入账号" autocomplete="off" id="username" class="layui-input">
            </div>
            <div class="layui-form-item input-item">
                <label for="password">密码</label>
                <input type="password" lay-verify="required|password" name="password" placeholder="请输入密码" autocomplete="off" id="password" class="layui-input">
            </div>
            <div class="layui-form-item input-item captcha-box">
                <label for="captcha">验证码</label>
                <input type="text"  name="captcha" placeholder="请输入验证码" autocomplete="off" id="captcha" maxlength="4" class="layui-input">
                <img src="data:image/jpg/png/gif;base64,<?php echo $_smarty_tpl->tpl_vars['captcha']->value;?>
" class="img ok-none-select" id="captchaImg">
            </div>
            <div class="layui-form-item">
                <button class="layui-btn layui-block" lay-filter="login" lay-submit="">登录</button>
            </div>
        </form>
    </div>
    <!--js逻辑-->
    <?php echo '<script'; ?>
 src="<?php echo __STATIC__;?>
/lib/layui/layui.js"><?php echo '</script'; ?>
>
    <?php echo '<script'; ?>
>
        layui.use(["form", "okUtils", "okLayer"], function () {
            let form = layui.form;
            let $ = layui.jquery;
            let okUtils = layui.okUtils;
            let okLayer = layui.okLayer;

            /**
             * 刷新验证码
             */
            $('#captchaImg').click(function (e) {
                okUtils.ajax("/admin/public/get_code", "get", {}, true).done(function (response) {
                    if(response.code == 1){
                        $('#captchaImg').attr('src','data:image/jpg/png/gif;base64,'+response.data)
                    }else{
                        okLayer.greenTickMsg(response.msg, function () {
                            window.location.reload()
                        })
                    }
                }).fail(function (error) {
                    console.log(error)
                });
            })



            /**
             * 表单提交
             */
            form.on("submit(login)", function (data) {
                okUtils.ajax("/admin/public/login", "post", data.field, true).done(function (response) {
                    okLayer.greenTickMsg(response.msg, function () {
                        window.location.href = "/admin/Index/index";
                    })
                }).fail(function (error) {
                    console.log(error)
                });
                return false;
            });

            /**
             * 表单input组件单击时
             */
            $("#login .input-item .layui-input").click(function (e) {
                e.stopPropagation();
                $(this).addClass("layui-input-focus").find(".layui-input").focus();
            });

            /**
             * 表单input组件获取焦点时
             */
            $("#login .layui-form-item .layui-input").focus(function () {
                $(this).parent().addClass("layui-input-focus");
            });

            /**
             * 表单input组件失去焦点时
             */
            $("#login .layui-form-item .layui-input").blur(function () {
                $(this).parent().removeClass("layui-input-focus");
                if ($(this).val() != "") {
                    $(this).parent().addClass("layui-input-active");
                } else {
                    $(this).parent().removeClass("layui-input-active");
                }
            })
        });
    <?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
