@extends($layout)

@section('box')

    <div class="box-header">
        <form id="formSearch" class="form-horizontal" method="POST" action="{{url('admins/index')}}">

            <div class="input-group margin search-input col-sm-3">
                {{--多功能输入框--}}
                @include('layouts.plugins.DropdownsInput',['dropdowns'=>$dropdowns])
            </div>
            <div class="input-group margin search-input col-sm-4">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">交易时间</button>
                </span>
                {{--时间选择器--}}
                @include('layouts.plugins.Daterangepicker')
            </div>

            <div class="input-group margin search-input">
                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info" value="查询">查询</button>
            </div>
        </form>
    </div>

    <div class="box-label">
        <a href="{{url('admins/create')}}" class="btn btn-info">添加管理员</a>
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <table id="data-tables" class="table table-bordered table-striped" data-url="{{url('admins/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name">姓名</th>
                <th data-name="phone">手机号码</th>
                <th data-name="email" data-sort="true" data-default-sort="desc">E-mail</th>
                <th data-name="status">状态</th>
                <th data-name="created_at">注册时间</th>
                <th data-name="">操作</th>
            </tr>
            </thead>
            <tbody>

                {{--DataTables插件--}}
                @include('layouts.plugins.DataTables')

            </tbody>
            <tfoot>
            <tr>
                <th>ID</th>
                <th>姓名</th>
                <th>手机号码</th>
                <th>E-mail</th>
                <th>状态</th>
                <th>注册时间</th>
            </tr>
            </tfoot>
        </table>
    </div>

@endsection

@push('script')
    <script>
        /**
         * DataTables 初始化
         */
        var tables = DataTableLoad();

        /**
         * 列美化
         *
         */
        function decorateColumn()
        {
            return [
                {
                    "targets": 4,   //状态
                    "className": 'td-center',
                    "render": function (data,type,row){
                        var btn = row.status==1 ? 'info' : 'danger';
                        var i = row.status==1 ? 'check' : 'times';
                        return `<button type="button" onclick="toggleStatus(this)" data-url="{{url('admins/status')}}`+`/` + row.id + `" data-status="` + row.status + `" class="btn btn-` + btn +` btn-circle"><i class="fa fa-` + i + `"></i> </button>`;
                    }
                },
            ];
        }

        /**
         * 重构操作栏
         *
         * @param data
         * @param type
         * @param row
         * @returns {string}
         */
        function getButton(data,type,row)
        {
            var html = '';
            html += '<a href="admins/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="admins/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }

        /**
         * 状态切换
         * @param that
         */
        function toggleStatus(that) {
            sweetConfirm('确定修改状态吗？',function (isConfirm) {
                if(!isConfirm) return false;

                $.ajax({
                    url:$(that).data('url'),
                    data:{'status':$(that).data('status'),'_token':'{{csrf_token()}}'},
                    type:'POST',
                    success:function(result){
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
                });
            });
        }

    </script>
@endpush