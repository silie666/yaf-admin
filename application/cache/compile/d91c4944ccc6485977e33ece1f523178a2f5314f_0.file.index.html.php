<?php
/* Smarty version 3.1.36, created on 2020-12-28 17:44:14
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/rbac/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fe9a8ee38d905_82621678',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd91c4944ccc6485977e33ece1f523178a2f5314f' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/rbac/index.html',
      1 => 1609148653,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fe9a8ee38d905_82621678 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
<div class="ok-body">
	<!--面包屑导航区域-->
	<ul class="layui-tab-title">
		<li class="layui-this">
			<a href="/admin/Rbac/index">角色管理</a>
		</li>
	</ul>
	<div class="layui-row">
		<from class="layui-form ok-search-form">
			<div class="layui-inline">
				<div class="layui-input-inline">
					<button class="layui-btn" type="button" id="edit" data-id="">添加角色</button>
				</div>
			</div>
		</from>
	</div>
	<!--数据表格-->
	<table class="layui-hide" id="tableId" lay-filter="tableFilter"></table>
</div>
<!--js逻辑-->
<?php echo '<script'; ?>
 src="<?php echo __STATIC__;?>
/lib/layui/layui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>

	layui.use(['form',"table",'jquery','okLayer','okUtils'], function () {
		okLoading.close();


		let $ = layui.$,
				okUtils = layui.okUtils,
				listTable = layui.table,
				data = <?php echo $_smarty_tpl->tpl_vars['data']->value;?>
,
				okLayer = layui.okLayer;

		let table = listTable.render({
			elem: '#tableId',
			data:data,
			limit: 20,
			cols: [[
				{field: "id", title: "ID", sort: true},
				{field: "name", title: "角色名称"},
				{field: "remark", title: "角色描述"},
				{field: "status", title: "状态",templet: function (item) {
						if(item.status == 1){
							return '<span style="color:green;">已启用</span>';
						}else{
							return '<span style="color:red;">已禁用</span>';
						}
					}
				},
				{title: "操作",  fixed: "right", templet:function (item) {
						if(item.id != 1){
							return '<div class="layui-btn-group">' +
									'  <button type="button" class="layui-btn layui-btn-xs" id="edit" data-id="'+item.id+'">编辑</button>' +
									'  <button type="button" class="layui-btn layui-btn-danger layui-btn-xs" id="del" data-id="'+item.id+'">删除</button>' +
									'</div>'
						}else{
							return ''
						}
					}
				}
			]],
			done: function (res, curr, count) {
				console.info(res, curr, count);
			}
		});


		$('body').on('click',"#edit",function () {
			let id = $(this).attr("data-id");
			let obj = {
				id: id
			}
			let url  = `/admin/Rbac/edit?${encodeSearchParams(obj)}`;
			okLayer.open("编辑",url, "90%", "90%", null, function () {
			})
		})

		$('body').on('click',"#del",function () {
			let id = $(this).attr("data-id");
			let params = {
				id: id
			}
			okLayer.confirm("确定要删除吗？", function (index) {
				layer.close(index);
				okUtils.ajax("/admin/Rbac/delete", "get",params, true).done(function (response) {
					okLayer.greenTickMsg(response.msg, function () {
						window.location.reload();
					});
				}).fail(function (error) {
					console.log(error)
				});
			})

		})

	});

<?php echo '</script'; ?>
>
</body>
</html><?php }
}
