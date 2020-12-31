<?php
/* Smarty version 3.1.36, created on 2020-12-29 16:43:34
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/admin_user_edit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5feaec3606c445_89009261',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e9b8599c400371e75e6ff5ee3c7bf994cff0ae9f' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/admin_user_edit.html',
      1 => 1609231410,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5feaec3606c445_89009261 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
<div class="ok-body">
    <!--form表单-->
    <form class="layui-form ok-form">
        <div class="layui-form-item">
            <label class="layui-form-label">帐号</label>
            <div class="layui-input-block">
                <input type="text" name="user_login" placeholder="帐号" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['user_login'];?>
">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">密码</label>
            <div class="layui-input-block">
                <input type="password" name="user_pass" placeholder="密码" autocomplete="off" class="layui-input"  value="">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">昵称</label>
            <div class="layui-input-block">
                <input type="text" name="user_nickname" placeholder="昵称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['user_nickname'];?>
">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">邮箱</label>
            <div class="layui-input-block">
                <input type="email" name="user_email" placeholder="邮箱" autocomplete="off" class="layui-input" lay-verify="email" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['user_email'];?>
">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">角色</label>
            <div class="layui-input-block">
                <select name="role_id" lay-verify="" lay-search>
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['roles']->value, 'vo', false, 'k');
$_smarty_tpl->tpl_vars['vo']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['vo']->value) {
$_smarty_tpl->tpl_vars['vo']->do_else = false;
?>
                        <option value="<?php echo $_smarty_tpl->tpl_vars['vo']->value['id'];?>
" <?php if ($_smarty_tpl->tpl_vars['vo']->value['id'] == $_smarty_tpl->tpl_vars['info']->value['role_id']) {?> selected  <?php }?>> <?php echo $_smarty_tpl->tpl_vars['vo']->value['name'];?>
</option>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                </select>
            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['id'];?>
">
                <button class="layui-btn" lay-submit lay-filter="edit">立即提交</button>
                <button type="reset" class="layui-btn layui-btn-primary">重置</button>
            </div>
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
    layui.use(['form', "tree",'okUtils','okLayer'], function () {
        let form = layui.form,  okUtils = layui.okUtils,okLayer=layui.okLayer;
        okLoading.close();
        form.on('submit(edit)', function (data) {
            okUtils.ajax("/admin/User/admin_user_edit", "post", data.field, true).done(function (response) {
                console.log(response);
                okLayer.greenTickMsg(response.msg, function () {
                    parent.layer.close(parent.layer.getFrameIndex(window.name));
                    window.location.reload();
                });
            }).fail(function (error) {
                console.log(error)
            });
            return false;
        });


    })
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
