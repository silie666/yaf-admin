<?php
/* Smarty version 3.1.36, created on 2021-01-04 16:47:59
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/rbac/edit.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5ff2d63f219cb3_89526083',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3a71934301422e2dbabd17902956637fbe519d8e' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/rbac/edit.html',
      1 => 1609750053,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ff2d63f219cb3_89526083 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
<div class="ok-body">
    <!--form表单-->
    <form class="layui-form ok-form">
        <div class="layui-form-item">
            <label class="layui-form-label">角色名称</label>
            <div class="layui-input-block">
                <input type="text" name="name" placeholder="角色名称" autocomplete="off" class="layui-input" lay-verify="required" value="<?php echo $_smarty_tpl->tpl_vars['info']->value['name'];?>
">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">角色备注</label>
            <div class="layui-input-block">
                <input type="text" name="remark" placeholder="角色备注" autocomplete="off" class="layui-input"  value="<?php echo $_smarty_tpl->tpl_vars['info']->value['remark'];?>
">
            </div>
        </div>
        <div class="layui-form-item">
            <label class="layui-form-label">角色权限</label>
            <div class="layui-input-block">
                <div id="permissionTree"></div>
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
        let form = layui.form, tree = layui.tree, okUtils = layui.okUtils,okLayer=layui.okLayer;

        okLoading.close();

        let data = <?php echo $_smarty_tpl->tpl_vars['menu']->value;?>
;
        tree.render({
            id: "id",
            elem: "#permissionTree",
            // data: okMock.permission.list,
            data: data,
            showCheckbox: true
        });

        form.on('submit(edit)', function (data) {
            let checkData = tree.getChecked('id');
            let menu_id = getCheckedId(checkData)
            let obj = {
                id:data.field.id,
                name:data.field.name,
                remark:data.field.remark,
                menu_id:menu_id,
            }
            okUtils.ajax("/admin/Rbac/edit", "post", obj, true).done(function (response) {
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

        //获取所有选中的节点id
        function getCheckedId(data) {
            let id = "";
            $.each(data, function (index, item) {
                if (id != "") {
                    id = id + "," + item.id;
                }
                else {
                    id = item.id;
                }
                //item 没有children属性
                if (item.children != null) {
                    let i = getCheckedId(item.children);
                    if (i != "") {
                        id = id + "," + i;
                    }
                }
            });
            return id;
        }
    })
<?php echo '</script'; ?>
>
</body>
</html>
<?php }
}
