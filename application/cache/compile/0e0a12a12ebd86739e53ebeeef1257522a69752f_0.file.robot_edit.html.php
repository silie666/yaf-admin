<?php
/* Smarty version 3.1.36, created on 2021-01-04 10:51:48
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/robot_edit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5ff282c4c3d334_98674432',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e0a12a12ebd86739e53ebeeef1257522a69752f' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/robot_edit.html',
      1 => 1609728704,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ff282c4c3d334_98674432 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
<div class="ok-body">
    <!--form表单-->
    <form class="layui-form ok-form">

        <div class="layui-form-item">
            <label class="layui-form-label">昵称</label>
            <div class="layui-input-block">
                <input type="text" name="user_nickname" placeholder="昵称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['user_nickname'];?>
">
            </div>
        </div>

        <div class="layui-form-item">
            <label class="layui-form-label">头像</label>
            <div class="layui-input-block">

                <button type="button" class="layui-btn layui-btn-primary" id="upload_img">上传图片</button>
                <div id="upload_img_list" name="avatar" data-img_num="1" data-value="<?php echo $_smarty_tpl->tpl_vars['info']->value['avatar'];?>
"> </div>

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

    $("#upload_img").upfile($("#upload_img_list").attr('data-img_num'),$("#upload_img_list").attr('data-value'))


    layui.use(['form', "tree",'okUtils','okLayer'], function () {
        let form = layui.form,  okUtils = layui.okUtils,okLayer=layui.okLayer;
        okLoading.close();
        form.on('submit(edit)', function (data) {
            okUtils.ajax("/admin/User/robot_edit", "post", data.field, true).done(function (response) {
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
