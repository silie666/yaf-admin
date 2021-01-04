<?php
/* Smarty version 3.1.36, created on 2021-01-04 10:44:16
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/robot_index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5ff28101000d40_06337957',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2d7dd9ebf70ae23eb355697eaa508656774c4146' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/robot_index.html',
      1 => 1609728254,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5ff28101000d40_06337957 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
<div class="ok-body">
    <!--面包屑导航区域-->
    <ul class="layui-tab-title">
        <li class="layui-this">
            <a href="/admin/User/robot_index">马甲用户</a>
        </li>
    </ul>
    <div class="layui-row">
        <from class="layui-form ok-search-form">
            <div class="layui-inline">
                <label class="layui-form-label">用户昵称</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" placeholder="用户昵称" autocomplete="off" name="user_nickname">
                </div>
            </div>
            <div class="layui-inline">
                <div class="layui-input-inline">
                    <button class="layui-btn" lay-submit="" lay-filter="search">
                        <i class="layui-icon">&#xe615;</i>
                    </button>
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
            form = layui.form,
            listTable = layui.table,
            sex_type = <?php echo $_smarty_tpl->tpl_vars['sex_type']->value;?>
,
            okLayer = layui.okLayer;
        let table = listTable.render({
            elem: '#tableId',
            url:"/admin/user/robot_data",
            parseData: function(res){ //res 即为原始返回的数据
                return {
                    "code":res.code,
                    "msg":res.msg,
                    "count": res.data.count, //解析数据长度
                    "data": res.data.list //解析数据列表
                };
            },
            page:true,
            toolbar: true,
            toolbar: "#toolbarTpl",
            limit: 10,
            cols: [[
                {field: "id", title: "ID", sort: true},
                {title: "马甲信息",templet:function (item) {
                        return '<img src="'+item.avatar+'" width="30">'+item.user_nickname+'</span><span>['+sex_type[item.sex]+']</span>'
                    }},
                {field: "create_time", title: "创建时间"},
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

        form.on("submit(search)", function (data) {
            table.reload({
                where: data.field,
                page: {curr: 1}
            });
            return false;
        });


        $('body').on('click',"#edit",function () {
            let id = $(this).attr("data-id");
            let obj = {
                id: id
            }
            let url  = `/admin/User/robot_edit?${encodeSearchParams(obj)}`;
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
                okUtils.ajax("/admin/User/robot_del", "get",params, true).done(function (response) {
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

<!-- 头工具栏模板 -->
<?php echo '<script'; ?>
 type="text/html" id="toolbarTpl">
    <div class="layui-btn-container">
        <button class="layui-btn layui-btn-sm layui-btn-normal" id="edit" data-id="">管理员添加</button>
    </div>
<?php echo '</script'; ?>
>

</body>
</html><?php }
}
