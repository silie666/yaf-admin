<?php
/* Smarty version 3.1.36, created on 2020-12-31 10:41:22
  from '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/member.html' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.36',
  'unifunc' => 'content_5fed3a52473027_91931657',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '78e159a8ebd91e172dab8147c8a558c70858ef35' => 
    array (
      0 => '/home/wyf/project/phptest/yaf/application/modules/Admin/views/user/member.html',
      1 => 1609323802,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_5fed3a52473027_91931657 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_subTemplateRender(Yaf\Application::app()->getConfig()->user->header_html, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, true);
?>
</head>
<body>
<div class="ok-body">
    <!--面包屑导航区域-->
    <ul class="layui-tab-title">
        <li class="layui-this">
            <a href="/admin/User/member">普通用户</a>
        </li>
    </ul>
    <div class="layui-row">
        <from class="layui-form ok-search-form">

            <div class="layui-inline">
                <label class="layui-form-label">关键字</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" placeholder="关键字" autocomplete="off" name="key_words">
                </div>
            </div>

            <div class="layui-inline">
                <label class="layui-form-label">注册时间</label>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" placeholder="开始" autocomplete="off" id="start_time" name="start_time" lay-key="1">
                </div>
                <span>~</span>
                <div class="layui-input-inline">
                    <input type="text" class="layui-input" placeholder="截止" autocomplete="off" id="end_time" name="end_time" lay-key="2">
                </div>
            </div>

            <div class="layui-inline">
                <label class="layui-form-label">是否禁用</label>
                <div class="layui-input-inline">
                    <select name="forbid_publish" lay-verify="" lay-search="">
                        <option value="">请选择</option>
                        <option value="0">否</option>
                        <option value="1">是</option>
                    </select>
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

    layui.use(['form',"table",'jquery','okLayer','okUtils','laydate'], function () {
        okLoading.close();


        let $ = layui.$,
            okUtils = layui.okUtils,
            form = layui.form,
            listTable = layui.table,
            laydate = layui.laydate,
            sex_type = <?php echo $_smarty_tpl->tpl_vars['sex_type']->value;?>
,
            okLayer = layui.okLayer;

        laydate.render({elem: "#start_time", type: "datetime"});
        laydate.render({elem: "#end_time", type: "datetime"});

        let table = listTable.render({
            elem: '#tableId',
            url:"/admin/user/member_data",
            parseData: function(res){ //res 即为原始返回的数据
                return {
                    "code":res.code,
                    "msg":res.msg,
                    "count": res.data.count, //解析数据长度
                    "data": res.data.list //解析数据列表
                };
            },
            page:true,
            limit: 10,
            cols: [[
                {field: "id", title: "ID",  sort: true},
                {title: "用户信息",templet:function (item) {
                        return '<img src="'+item.avatar+'" width="30">'+item.user_nickname+'</span><span>['+sex_type[item.sex]+']</span>'
                    }},
                {field: "create_time", title: "注册时间",},
                {field: "last_login_time", title: "最近登录时间",},
                {field: "last_login_ip", title: "最后登录ip",},
                {field: "user_status", title: "状态",templet: function (item) {
                        if(item.user_status == 1){
                            return '<span style="color:green;">已启用</span>';
                        }else{
                            return '<span style="color:red;">已禁用</span>';
                        }
                    }
                },
                {field: "forbid_text", title: "禁言"},
                {title: "操作",  fixed: "right",width: 140, templet:function (item) {
                        let str = ''
                        if(item.user_status == 1){
                            str = '  <button type="button" class="layui-btn layui-btn-warm layui-btn-xs" id="update_status" data-status="0" data-id="'+item.id+'">停用</button>'
                        }else{
                            str = '  <button type="button" class="layui-btn layui-btn-normal  layui-btn-xs" id="update_status" data-status="1" data-id="'+item.id+'">启用</button>'
                        }
                        let str2 = ''
                        if(item.forbid_publish==1){
                            str2 = '  <button type="button" class="layui-btn layui-btn-normal  layui-btn-xs" id="not_forbid"  data-id="'+item.id+'">解除禁言</button>'
                        }else{
                            str2 = '  <button type="button" class="layui-btn layui-btn-warm layui-btn-xs" id="forbid_publish" data-id="'+item.id+'">禁言</button>'
                        }
                        return '<div class="layui-btn-group">' +
                            str+str2+
                            '  <button type="button" class="layui-btn layui-btn-danger layui-btn-xs" id="del" data-id="'+item.id+'">删除</button>' +
                            '</div>'
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

        $('body').on('click',"#del",function () {
            let id = $(this).attr("data-id");
            let params = {
                id: id
            }
            okLayer.confirm("确定要删除吗？", function (index) {
                layer.close(index);
                okUtils.ajax("/admin/User/admin_user_delete", "get",params, true).done(function (response) {
                    okLayer.greenTickMsg(response.msg, function () {
                        window.location.reload();
                    });
                }).fail(function (error) {
                    console.log(error)
                });
            })

        })


        $('body').on('click',"#update_status",function () {
            let id = $(this).attr("data-id");
            let status = $(this).attr("data-status");
            let params = {
                id: id,
                status:status
            }
            okLayer.confirm("确定要执行吗？", function (index) {
                layer.close(index);
                okUtils.ajax("/admin/User/admin_user_status", "get",params, true).done(function (response) {
                    okLayer.greenTickMsg(response.msg, function () {
                        window.location.reload();
                    });
                }).fail(function (error) {
                    console.log(error)
                });
            })
        })




        $('body').on('click',"#forbid_publish",function () {
            let id = $(this).attr("data-id");
            let obj = {
                id: id
            }
            let url  = `/admin/User/member_forbidpublish?${encodeSearchParams(obj)}`;
            okLayer.open("编辑",url, "90%", "90%", null, function () {
            })
        })

        $('body').on('click',"#not_forbid",function () {
            let id = $(this).attr("data-id");
            let status = $(this).attr("data-status");
            let params = {
                id: id,
                status:status
            }
            okLayer.confirm("确定要执行吗？", function (index) {
                layer.close(index);
                okUtils.ajax("/admin/User/admin_user_status", "get",params, true).done(function (response) {
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
