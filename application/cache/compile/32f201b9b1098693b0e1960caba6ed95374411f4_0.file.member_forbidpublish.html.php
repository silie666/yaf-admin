<?php
/* Smarty version 3.1.36, created on 2020-12-31 10:42:09
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/member_forbidpublish.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fed3a81cf4744_36427236',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '32f201b9b1098693b0e1960caba6ed95374411f4' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/member_forbidpublish.html',
      1 => 1609324500,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fed3a81cf4744_36427236 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
<div class="ok-body">
    <!--form表单-->
    <form class="layui-form ok-form">
        <div class="layui-form-item">
            <label class="layui-form-label">禁言原因</label>
            <div class="layui-input-block">
                <input type="text" name="forbid_excuse" placeholder="禁言原因" autocomplete="off" class="layui-input" lay-verify="required">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">禁言时长（天）</label>
            <div class="layui-input-block">
                <input type="text" name="forbid_num" placeholder="禁言时长" autocomplete="off" class="layui-input" lay-verify="required|number">
            </div>
        </div>


        <div class="layui-form-item">
            <div class="layui-input-block">
                <input type="hidden" name="id" value="<?php echo $_smarty_tpl->tpl_vars['id']->value;?>
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
            okUtils.ajax("/admin/User/member_forbidpublish", "post", data.field, true).done(function (response) {
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
