<?php
/* Smarty version 3.1.36, created on 2021-01-04 14:06:55
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/user_info.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5ff2b07fd66000_23251789',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '975aecfe1cb1b8e4472273138e827715908d14cf' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/user_info.html',
      1 => 1609740414,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ff2b07fd66000_23251789 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>

<div class="ok-body">
    <ul class="layui-tab-title">
        <li class="layui-this">
            <a href="/admin/User/user_info">修改个人信息</a>
        </li>
        <li>
            <a href="/admin/Setting/password">修改密码</a>
        </li>
    </ul>
    <!--form表单-->
    <div class="layui-tab-content" style="height: 100px;">
        <div class="layui-tab-item layui-show">
            <form class="layui-form ok-form" lay-filter="filter">
                <div class="layui-form-item">
                    <label class="layui-form-label">昵称</label>
                    <div class="layui-input-block">
                        <input type="text" name="user_nickname" placeholder="请输入昵称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $_smarty_tpl->tpl_vars['admin']->value['user_nickname'];?>
">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">性别</label>
                    <div class="layui-input-block">
                        <input type="radio" name="sex" value="0" title="保密" <?php if ($_smarty_tpl->tpl_vars['admin']->value['sex'] == 0) {?>checked <?php }?>>
                        <input type="radio" name="sex" value="1" title="男" <?php if ($_smarty_tpl->tpl_vars['admin']->value['sex'] == 1) {?>checked <?php }?>>
                        <input type="radio" name="sex" value="2" title="女" <?php if ($_smarty_tpl->tpl_vars['admin']->value['sex'] == 2) {?>checked <?php }?>>
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">头像</label>
                    <div class="layui-input-block">

                        <button type="button" class="layui-btn layui-btn-primary" id="upload_img">上传图片</button>
                        <div id="upload_img_list" name="avatar" data-img_num="2" data-value="<?php echo $_smarty_tpl->tpl_vars['admin']->value['avatar'];?>
"> </div>

                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <button class="layui-btn" lay-submit lay-filter="edit">立即提交</button>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<?php echo '<script'; ?>
 src="<?php echo __STATIC__;?>
/lib/layui/layui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>
    $("#upload_img").upfile($("#upload_img_list").attr('data-img_num'),$("#upload_img_list").attr('data-value'))


    layui.use(["form", "okLayer", "okUtils"], function () {
        let form = layui.form;
        let okLayer = layui.okLayer;
        let okUtils = layui.okUtils;
        okLoading.close();


        //普通图片上传

        form.on("submit(edit)", function (data) {
            okUtils.ajax("/admin/User/user_info", "post", data.field, true).done(function (response) {
                console.log(response);
                okLayer.greenTickMsg(response.msg, function () {

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

</html><?php }
}
