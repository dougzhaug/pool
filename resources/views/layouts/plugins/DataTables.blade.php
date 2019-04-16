
@push('link')
    <!-- Editable CSS -->
    <link rel="stylesheet" href="{{admin_asset('bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">
{{--    <link href="{{asset('static/admin/plugins/bower_components/datatables/jquery.dataTables.min.css')}}" rel="stylesheet" type="text/css" />--}}
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />

    <style>
        /*处理操作框内的按钮*/
        .tables-console {margin: 3px 0 0 5px;}
        .tables-console span {margin-right: 3px;}

        /*某一列居中展示*/
        .td-center {text-align:center;}

        /*某一列居左展示*/
        .td-left {text-align:left;}

        /*某一列居右展示*/
        .td-right {text-align:right;}
    </style>
@endpush

@push('script')
    <!-- DataTables -->
    <script src="{{admin_asset('bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{admin_asset('bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
{{--    <script src="{{asset('static/admin/plugins/bower_components/datatables/jquery.dataTables.min.js')}}"></script>--}}

    <script>

        /**
         * dataTable插件初始化
         */
        function DataTableLoad(url,tableName,formName) {

            tableName = tableName ? tableName : '#data-tables';
            formName = formName ? formName : false;
            url = url ? url : $(tableName).data('url');

            var column = [];
            var defaultSort = [0,'desc'];           //没有默认排序字段时，取第一个
            var target = [];
            $(tableName).children('thead').children('tr').children().map(function (k,v) {
                /*处理显示字段信息*/
                var thName = $(this).data('name');
                if(thName != undefined){
                    column.push({data:thName ? thName : null});
                }

                /*获取默认排序字段*/
                var default_sort = $(this).data('default-sort');
                if(default_sort){
                    defaultSort = [k,default_sort]
                }

                /*生成不允许排序字段*/
                var sort = $(this).data('sort');
                if(!sort){
                    target.push(k)
                }
            });

            return $(tableName).DataTable({
                serverSide: true,                   //开启服务器模式
                ajax: {                             //AJAX请求设置
                    url:url,
                    type: 'POST',
                    data: getFormData(formName),    //额外参数
                    headers: { 'X-CSRF-TOKEN' : '{{ csrf_token() }}' },
                },
                columns: column,                    //列表的展示字段
                paging: "{{$paging or true}}",      //是否分页
                lengthChange: true,                 //每页显示多少条
                searching: false,                   //搜索
                ordering: true,                     //排序
                info: true,                         //左下角信息
                autoWidth: false,                   //宽度自适应
                aaSorting: [ defaultSort ],         //默认排序
                aoColumnDefs: aoColumnDefs(target),
                language: {
                    processing: "数据加载中...",
                    info: "显示第 _START_ 至 _END_ 条，共 _TOTAL_ 条记录",
                    infoEmpty: "暂无数据",
                    sEmptyTable: "表中数据为空",
                    lengthMenu: "每页显示 _MENU_ 条记录",
                    paginate: {
                        first: "首页",
                        previous: "上一页",
                        next: "下一页",
                        last: "最后一页"
                    }
                }

            })
        }

        function aoColumnDefs(target) {
            return [
                {
                    "bSortable": false,
                    "aTargets": target              //禁止那些列不可以排序
                },
                {
                    "targets": -1,
                    "className": 'td-center',
                    "render": function (data,type,row){
                        return getButton(data,type,row);
                    }
                }
            ].concat(decorateColumn());
        }

        /**
         * 列的美化处理 （需重构）
         *
         */
        function decorateColumn()
        {
            return [];
        }

        /**
         * 公共搜索函数 （可重构）
         *
         * @param formName
         */
        function doSearch(formName)
        {
            tables.settings()[0].ajax.data = getFormData(formName);     //设置ajax请求参数
            tables.draw();  //重新触发请求
        }

        /**
         * 获取form数据
         * @param node
         */
        function getFormData(node) {
            var node = node ? node : '#formSearch';
            var dataArray = $(node).serializeArray();

            var data = {};
            $.each(dataArray, function() {
                data[this.name] = this.value;
            });

            return data;
        }

        /**
         * 操作栏 (需要重构)
         *
         * @param data
         * @param type
         * @param row
         * @returns {string}
         */
        function getButton(data,type,row)
        {
            var html = '';
            html += '<a href="{{url('role/create')}}" class="btn btn-success btn-xs tables-console tables-create"><span class="glyphicon glyphicon-plus"></span>添加</a>';
            html += '<a href="{{url('role/edit')}}/'+data.id+'" class="btn btn-primary btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<a href="{{url('role/destroy')}}/'+data.id+'" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</a>';
            return html;
        }

        /**
         * 删除操作（可重构）
         *
         * @param that
         * @returns {boolean}
         */
        function tablesDelete(that) {
            sweetConfirm('确定要删除吗？',function (isConfirm) {
                if(!isConfirm) return false;

                $.ajax({
                    url:$(that).data('url'),
                    data:{'_token':'{{csrf_token()}}'},
                    type: "DELETE",
                    success:function (result) {
                        if(!result.errorCode){
                            swal({'title':result.message,'type':'success'},function () {
                                window.location.reload();
                            });
                        }else{
                            swal(result.message,'','error');
                        }
                    },
                    error:function (err) {
                        swal(err.status + ' ' + err.statusText,'','error');
                    }
                })
            });
        }
    </script>
@endpush