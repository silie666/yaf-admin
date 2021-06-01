<?php
/* Smarty version 3.1.36, created on 2020-12-25 09:49:59
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/setting/password.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fe545472677c2_04054971',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0dcddbfdde209087172daa87bf06b617e8233129' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/setting/password.html',
      1 => 1608790566,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fe545472677c2_04054971 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>

<div class="ok-body">
	<ul class="layui-tab-title">
		<li>
			<a href="/admin/User/user_info">修改个人信息</a>
		</li>
        <li class="layui-this">
            <a href="/admin/Setting/password">修改密码</a>
        </li>
	</ul>
	<!--form表单-->
	<div class="layui-tab-content" style="height: 100px;">
		<div class="layui-tab-item layui-show">
			<form class="layui-form ok-form" lay-filter="filter">


				<div class="layui-form-item">
					<label class="layui-form-label">原始密码</label>
					<div class="layui-input-block">
						<input type="password" name="old_password" placeholder="请输入密码" autocomplete="off" class="layui-input" lay-verify="required">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">新密码</label>
					<div class="layui-input-block">
						<input type="password" name="password" placeholder="请输入密码" autocomplete="off" class="layui-input" lay-verify="required">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">重复新密码</label>
					<div class="layui-input-block">
						<input type="password" name="re_password" placeholder="请输入密码" autocomplete="off" class="layui-input" lay-verify="required">
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


	layui.use(["form", "okLayer", "okUtils"], function () {
		let form = layui.form;
		let okLayer = layui.okLayer;
		let okUtils = layui.okUtils;
		okLoading.close();

		form.on("submit(edit)", function (data) {
			okUtils.ajax("/admin/setting/password_post", "post", data.field, true).done(function (response) {
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
