<?php
/* Smarty version 3.1.36, created on 2020-12-24 14:05:45
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/setting/site.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fe42fb9988252_98514559',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1f2b6cc2c2cdd818ca707613c71117ce9d6b0c1d' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/setting/site.html',
      1 => 1608789939,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fe42fb9988252_98514559 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>

<div class="ok-body">
    <ul class="layui-tab-title">
        <li class="layui-this">
            <a href="/admin/Setting/site">网站设置</a>
        </li>
    </ul>
    <!--form表单-->
    <div class="layui-tab-content" style="height: 100px;">
        <div class="layui-tab-item layui-show">
            <form class="layui-form ok-form" lay-filter="filter">
                <div class="layui-form-item">
                    <label class="layui-form-label">网站名称</label>
                    <div class="layui-input-block">
                        <input type="text" name="options[site_name]" placeholder="请输入网站名称" autocomplete="off" class="layui-input"
                               lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['site_info']->value['site_name'];?>
">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">SEO标题</label>
                    <div class="layui-input-block">
                        <input type="text" name="options[site_seo_title]" placeholder="请输入SEO标题" autocomplete="off" class="layui-input"
                               lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['site_info']->value['site_seo_title'];?>
">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">SEO关键字</label>
                    <div class="layui-input-block">
                        <input type="text" name="options[site_seo_keywords]" placeholder="请输入SEO关键字" autocomplete="off" class="layui-input"
                               lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['site_info']->value['site_seo_keywords'];?>
">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">SEO描述</label>
                    <div class="layui-input-block">
                        <input type="text" name="options[site_seo_description]" placeholder="请输入SEO描述" autocomplete="off" class="layui-input"
                               lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['site_info']->value['site_seo_description'];?>
">
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">ICP备案</label>
                    <div class="layui-input-block">
                        <input type="text" name="options[site_icp]" placeholder="请输入ICP备案" autocomplete="off" class="layui-input"
                               lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['site_info']->value['site_icp'];?>
">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">公网安备</label>
                    <div class="layui-input-block">
                        <input type="text" name="options[site_gwa]" placeholder="请输入公网安备" autocomplete="off" class="layui-input" lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['site_info']->value['site_gwa'];?>
">
                    </div>
                </div>
                <div class="layui-form-item">
                    <label class="layui-form-label">站长邮箱</label>
                    <div class="layui-input-block">
                        <input type="text" name="options[site_admin_email]" placeholder="请输入站长邮箱" autocomplete="off" class="layui-input" lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['site_info']->value['site_admin_email'];?>
">
                    </div>
                </div>
                <div class="layui-form-item layui-form-text">
                    <label class="layui-form-label">统计代码</label>
                    <div class="layui-input-block">
                        <textarea name="options[site_analytics]" placeholder="请输入统计代码" class="layui-textarea"><?php echo $_smarty_tpl->tpl_vars['site_info']->value['site_analytics'];?>
</textarea>
                    </div>
                </div>

                <div class="layui-form-item">
                    <label class="layui-form-label">静态资源cdn地址</label>
                    <div class="layui-input-block">
                        <input type="text" name="cdn_settings[cdn_static_root]" placeholder="请输入静态资源cdn地址" autocomplete="off" class="layui-input"
                               lay-verify="" value="<?php echo $_smarty_tpl->tpl_vars['cdn_settings']->value['cdn_static_root'];?>
">
                        <span>不能以/结尾;oss使用,例:http://a.test.com</span>
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
            okUtils.ajax("/admin/setting/site_post", "post", data.field, true).done(function (response) {
                console.log(response);
                okLayer.greenTickMsg(response.msg, function () {
                    console.log(window.name)
                    parent.layer.close(parent.layer.getFrameIndex(window.name));
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
