<?php
/* Smarty version 3.1.36, created on 2020-12-25 09:50:04
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/setting/edit_wechat_gzh.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fe5454c99aac5_60285873',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'f4e8ccfc06ff1bb159da5375bba635dadb9aa205' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/setting/edit_wechat_gzh.html',
      1 => 1608790566,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fe5454c99aac5_60285873 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>

<div class="ok-body">
	<ul class="layui-tab-title">
		<li class="">
			<a href="/admin/Setting/edit_wechat_xcx">小程序设置</a>
		</li>
		<li class="layui-this">
			<a href="/admin/Setting/edit_wechat_gzh">公众号设置</a>
		</li>
	</ul>
	<!--form表单-->
	<div class="layui-tab-content" style="height: 100px;">
		<div class="layui-tab-item layui-show">
			<form class="layui-form ok-form" lay-filter="filter">
				<div class="layui-form-item">
					<label class="layui-form-label">名称</label>
					<div class="layui-input-block">
						<input type="text" name="app_name" placeholder="请输入名称" autocomplete="off" class="layui-input"
							   lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['wxapp']->value['app_name'];?>
">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">appid</label>
					<div class="layui-input-block">
						<input type="text" name="app_id" placeholder="请输入appid" autocomplete="off" class="layui-input"
							   lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['wxapp']->value['app_id'];?>
">
					</div>
				</div>

				<div class="layui-form-item">
					<label class="layui-form-label">app_secret</label>
					<div class="layui-input-block">
						<input type="text" name="app_secret" placeholder="请输入app_secret" autocomplete="off" class="layui-input"
							   lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['wxapp']->value['app_secret'];?>
">
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


	layui.use(["element", "form", "okLayer", "okUtils"], function () {
		let form = layui.form;
		let okLayer = layui.okLayer;
		let okUtils = layui.okUtils;
		okLoading.close();


		form.on("submit(edit)", function (data) {
			okUtils.ajax("/admin/setting/edit_wechat_gzh", "post", data.field, true).done(function (response) {
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
