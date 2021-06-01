<?php
/* Smarty version 3.1.36, created on 2020-12-28 11:07:02
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/menu/index.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fe94bd6211419_47561013',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'e5971fa707ec54a1b872c8cbe38691ed56db994a' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/menu/index.html',
      1 => 1609123640,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fe94bd6211419_47561013 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
<div class="ok-body">
    <!--面包屑导航区域-->
    <ul class="layui-tab-title">
        <li class="layui-this">
            <a href="/admin/Menu/index">后台菜单</a>
        </li>
    </ul>
    <div class="layui-row">
        <from class="layui-form ok-search-form">
                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <button class="layui-btn" type="button" id="list_sort" >排序</button>
                    </div>
                </div>

                <div class="layui-inline">
                    <div class="layui-input-inline">
                        <button class="layui-btn" type="button" id="add" data-id="">添加子菜单</button>
                    </div>
                </div>
        </from>
    </div>
    <!--数据表格-->
    <table class="layui-table layui-form" id="tree-table" lay-size="sm" lay-filter="tableFilter"></table>
</div>
<!--js逻辑-->
<?php echo '<script'; ?>
 src="<?php echo __STATIC__;?>
/lib/layui/layui.js"><?php echo '</script'; ?>
>
<?php echo '<script'; ?>
>

    layui.use(['form',"treeTable",'jquery','okLayer','okUtils'], function () {
        okLoading.close();

        let $ = layui.$,
            form = layui.form,
            treeTable = layui.treeTable,
            okUtils = layui.okUtils,
            okLayer = layui.okLayer;
        // 直接下载后url: './data/table-tree.json',这个配置可能看不到数据，改为data:[],获取自己的实际链接返回json数组
        let	table = treeTable.render({
            elem: '#tree-table',
            url:'/admin/Menu/json',
            icon_key: 'name',
            is_checkbox: false,
            end: function(e){
                form.render();
            },
            cols: [
                {
                    key: 'name',
                    title: '菜单名称',
                    width: '200px',
                    template: function(item){
                        if(item.type == 0){
                            return '<span style="color:green;">'+item.name+'</span>';
                        }else if(item.type == 1){
                            return '<span style="color:#aaa;">'+item.name+'</span>';
                        }else if(item.type == 2){
                            return '<span style="color:red;">'+item.name+'</span>';

                        }
                    }
                },
                {
                    key: 'id',
                    title: 'ID',
                    width: '100px',
                    align: 'center',
                },
                {
                    key: 'list_order',
                    title: '排序',
                    width: '100px',
                    align: 'center',
                    template: function(item){
                        return '<input name="list_orders['+item.id+']" data-id="'+item.id+'" type="text" size="3" value="'+item.list_order+'" class="layui-input" >';
                    },
                },
                {
                    key: 'action_name',
                    title: '路径',
                    width: '100px',
                    align: 'center',
                },
                {
                    key:'status',
                    title: '状态',
                    width: '100px',
                    align: 'center',
                    template: function(item){
                        if(item.status == 1) {
                            return '<span style="color:green;">显示</span>';
                        }else{
                            return '<span style="color:red;">隐藏</span>';
                        }
                    }
                },
                {
                    title: '操作',
                    align: 'center',
                    template: function(item){
                        // return '<a class="layui-btn">添加子菜单</a> | <a  href="/detail?id='+item.id+'">编辑</a> | <a  href="/detail?id='+item.id+'">删除</a>';
                        return '<div class="layui-btn-group">' +
                            '  <button type="button" class="layui-btn" id="add" data-id="'+item.id+'" >添加子菜单</button>' +
                            '  <button type="button" class="layui-btn" id="edit" data-id="'+item.id+'">编辑</button>' +
                            '  <button type="button" class="layui-btn layui-btn-danger" id="del" data-id="'+item.id+'">删除</button>' +
                            '</div>'
                    }
                }
            ]
        })
        ;
        $('body').on('click','#list_sort',function () {
            let list_orders = []

            $("input[name^='list_orders']").each(function (i, el) {
                list_orders[$(el).attr('data-id')] = $(this).val();
            })
            okLayer.confirm("确定要排序吗？", function (index) {
                layer.close(index);
                okUtils.ajax("/admin/Menu/list_order", "post", {list_orders: list_orders}, true).done(function (response) {
                    okLayer.greenTickMsg(response.msg, function () {
                        window.location.reload();
                    });
                }).fail(function (error) {
                    console.log(error)
                });
            })
        });


        $('body').on('click',"#add",function () {
            let id = $(this).attr("data-id");
            let obj = {
                parent_id: id
            }
            let url  = `/admin/Menu/add?${encodeSearchParams(obj)}`;
            okLayer.open("添加子菜单",url, "90%", "90%", null, function () {
            })
        })

        $('body').on('click',"#edit",function () {
            let id = $(this).attr("data-id");
            let obj = {
                id: id
            }
            let url  = `/admin/Menu/edit?${encodeSearchParams(obj)}`;
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
                okUtils.ajax("/admin/Menu/delete", "get",params, true).done(function (response) {
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
