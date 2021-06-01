<?php
/* Smarty version 3.1.36, created on 2020-12-25 11:40:59
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/menu/add.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fe55f4b84c6d5_91778184',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '043fe3186df0088bb99c2bcad9198b69156f2f20' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/menu/add.html',
      1 => 1608867656,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fe55f4b84c6d5_91778184 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
<div class="ok-body">
    <!--面包屑导航区域-->
    <ul class="layui-tab-title">
        <li class="">
            <a href="/admin/Menu/index">后台菜单</a>
        </li>
    </ul>
    <div class="layui-row">

    </div>
    <!--form表单-->
    <div class="layui-tab-content" style="height: 100px;">
        <div class="layui-tab-item layui-show">
            <form class="layui-form ok-form" lay-filter="filter">

                <div class="layui-form-item">
                    <label class="layui-form-label">上级</label>
                    <div class="layui-input-block">
                        <select name="parent_id" lay-verify="required">
                            <option value="0">作为一级菜单</option>
                            <?php echo $_smarty_tpl->tpl_vars['select_category']->value;?>

                        </select>
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="name" placeholder="请输入名称" autocomplete="off" class="layui-input" lay-verify="required">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">应用</label>
                    <div class="layui-input-block">
                        <input type="text" name="app" placeholder="请输入应用" autocomplete="off" class="layui-input" lay-verify="required">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">控制器</label>
                    <div class="layui-input-block">
                        <input type="text" name="controller" placeholder="请输入控制器" autocomplete="off" class="layui-input" lay-verify="required">
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">方法</label>
                    <div class="layui-input-block">
                        <input type="text" name="action" placeholder="请输入名称" autocomplete="off" class="layui-input" lay-verify="required">
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">参数</label>
                    <div class="layui-input-block">
                        <input type="text" name="param" placeholder="请输入参数" autocomplete="off" class="layui-input" >
                        <span>例:id=3&p=3</span>
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">图标</label>
                    <div class="layui-input-block">
                        <input type="text" name="icon" placeholder="请输入图标" autocomplete="off" class="layui-input" >
                        <a target="_blank" href="https://www.layui.com/doc/element/icon.html">选择图标</a><span>复制后把&#去掉</span>
                    </div>
                </div>


                <div class="layui-form-item">
                    <label class="layui-form-label">状态</label>
                    <div class="layui-input-block">
                        <input type="radio" name="status" value="1" title="在左侧菜单显示" checked>
                        <input type="radio" name="status" value="0" title="在左侧菜单隐藏" >
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">类型</label>
                    <div class="layui-input-block">
                        <input type="radio" name="type" value="1" title="有界面可访问菜单" checked>
                        <input type="radio" name="type" value="2" title="无界面可访问菜单" >
                        <input type="radio" name="type" value="0" title="只作为菜单" >
                    </div>
                </div>

                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">备注</label>
                    <div class="layui-input-block">
                        <textarea name="remark" placeholder="请输入内容" class="layui-textarea"></textarea>
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
<!--js逻辑-->
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
            okUtils.ajax("/admin/Menu/add", "post", data.field, true).done(function (response) {
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
</html><?php }
}
