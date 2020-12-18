<?php
/* Smarty version 3.1.36, created on 2020-12-16 15:18:47
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/system/setting.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fd9b4d7f215a0_02646728',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '95507948d729c3e0b63a62b58d4eee6192a9f8d4' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/system/setting.html',
      1 => 1608103026,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fd9b4d7f215a0_02646728 (Smarty_Internal_Template $_smarty_tpl) {
?><!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <title>系统设置</title>
   <link rel="stylesheet" href="<?php echo __CSS__;?>
/okadmin.css">
   <?php echo '<script'; ?>
 type="text/javascript" src="<?php echo __JS__;?>
/okconfig.js"><?php echo '</script'; ?>
>

</head>
<body>
<div class="layui-card-body ok-setting">
   <form class="layui-form" action="javascript:;">
      <div class="layui-form-item">
         <label class="layui-form-label set-label">主题色：</label>
         <div class="layui-input-block">
            <input lay-filter="theme" type="radio" name="theme" value="" title="默认">
            <input lay-filter="theme" type="radio" name="theme" value="blue_theme" title="蓝色"/>
            <input lay-filter="theme" type="radio" name="theme" value="orange_theme" title="橘色"/>
         </div>
      </div>
      <div class="layui-form-item">
         <label class="layui-form-label set-label">导航箭头：</label>
         <div class="layui-input-block">
            <input lay-filter="arrow" type="radio" name="arrow" value="" title="默认">
            <input lay-filter="arrow" type="radio" name="arrow" value="ok-arrow2" title="箭头">
            <input lay-filter="arrow" type="radio" name="arrow" value="ok-arrow3" title="加号">
         </div>
      </div>
      <div class="layui-form-item">
         <label class="layui-form-label set-label">切换刷新：</label>
         <div class="layui-input-block">
            <input lay-filter="refresh" type="checkbox" name="refresh" lay-skin="switch" lay-text="开启|关闭">
            <!--<input lay-filter="arrow" type="checkbox" name="sex" value="" title="默认">-->
         </div>
      </div>
      <div class="layui-form-item">
         <label class="layui-form-label set-label">tab记忆：</label>
         <div class="layui-input-block">
            <input lay-filter="menu" type="checkbox" name="menu" lay-skin="switch" lay-text="开启|关闭">
            <!--<input lay-filter="arrow" type="checkbox" name="sex" value="" title="默认">-->
         </div>
      </div>
   </form>
</div>
</body>
</html>
<?php echo '<script'; ?>
 type="text/javascript" src="<?php echo __STATIC__;?>
/lib/layui/layui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
 type="text/javascript">
   layui.use(['jquery', 'form', 'okUtils'], function () {
      var $ = layui.jquery,
         form = layui.form,
         okUtils = layui.okUtils,
         parentBody = parent.document.body;// 父级dom
      var config = okUtils.local("okConfig") || okConfig || {};
      var ok_arrow = "ok-arrow2 ok-arrow3";

      $("input[name=theme]").each(function (i,item) {
         if(config.theme == $(item).val()){
            $(item).prop("checked", true);
         }else {
            $(item).prop("checked", false);
         }
      });
      $("input[name=arrow]").each(function (i,item) {
         if(config.menuArrow == $(item).val()){
            $(item).prop("checked", true);
         }else {
            $(item).prop("checked", false);
         }
      });
      $("input[name=refresh]").prop("checked", config.isTabRefresh);
      $("input[name=menu]").prop("checked", config.isTabMenu);

      form.render();
      form.on('radio(arrow)', function (data) { //更改导航箭头样式
         $(parentBody).find("#navBar").removeClass(ok_arrow);
         $(parentBody).find("#navBar").addClass(data.value);
         config.menuArrow = data.value;
         okUtils.local("okConfig", config);
      });

      form.on('switch(refresh)', function (data) { //切换刷新
         config.isTabRefresh = data.elem.checked;
         okUtils.local("okConfig", config);
      });

      form.on('switch(menu)', function (data) { //tab记忆
         config.isTabMenu = data.elem.checked;
         okUtils.local("okConfig", config);
      });

      form.on('radio(theme)', function (data) {
         $(parentBody).find(".layui-layout-admin").removeClass("orange_theme blue_theme");
         $(parentBody).find(".layui-layout-admin").addClass(data.value);
         config.theme = data.value;
         okUtils.local("okConfig", config);
      });

   });
<?php echo '</script'; ?>
><?php }
}
