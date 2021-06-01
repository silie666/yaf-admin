<?php
/* Smarty version 3.1.36, created on 2021-06-01 13:44:32
  from '/files/php/yaf-admin/application/modules/Admin/views/index/console.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_60b5c9402b80a8_30694916',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '176a39ab8199fc1359cb0073cfb94230ead2d647' => 
    array (
      0 => '/files/php/yaf-admin/application/modules/Admin/views/index/console.html',
      1 => 1622450396,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_60b5c9402b80a8_30694916 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body class="layui-layout-body">
不知道写什么，自由发挥吧

<?php echo '<script'; ?>
 src="<?php echo __STATIC__;?>
/lib/layui/layui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>

	okLoading.close();
<?php echo '</script'; ?>
>


</body>
</html>
















<?php }
}
