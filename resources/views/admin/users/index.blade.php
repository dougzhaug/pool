@extends($layout)

@section('box')

    <div class="box-header">
        <form id="formSearch" class="form-horizontal" method="POST" action="{{url('users/index')}}">

            <div class="input-group margin search-input col-sm-3">
                {{--多功能输入框--}}
                @include('layouts.plugins.DropdownsInput',['dropdowns'=>$dropdowns])
            </div>
            <div class="input-group margin search-input col-sm-4">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">注册时间</button>
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
        {{--<a href="{{url('users/create')}}" class="btn btn-info">添加用户</a>--}}
    </div>

    <!-- /.box-header -->
    <div class="box-body">
        <table id="data-tables" class="table table-bordered table-striped" data-url="{{url('users/index')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="nickname">昵称</th>
                <th data-name="openid">OpenID</th>
                <th data-name="gender">性别</th>
                <th data-name="subject">所属科目</th>
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
                <th>昵称</th>
                <th>OpenID</th>
                <th>性别</th>
                <th>所属科目</th>
                <th>状态</th>
                <th>注册时间</th>
                <th>操作</th>
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
                    "targets": 1,   //昵称
                    "render": function (data,type,row){
                        return `<img src="`+row.avatar+`" width="40" height="40" />`+row.nickname;
                    }
                },
                {
                    "targets": 3,   //性别
                    "render": function (data,type,row){
                        switch (row.gender) {
                            case 0:
                                return '未知';
                                break;
                            case 1:
                                return '男';
                                break;
                            case 2:
                                return '女';
                                break;
                        }
                    }
                },
                {
                    "targets": 4,   //所属科目
                    "render": function (data,type,row){
                        return row.subject.name;
                    }
                },
                {
                    "targets": 5,   //状态
                    "className": 'td-center',
                    "render": function (data,type,row){
                        var btn = row.status==1 ? 'info' : 'danger';
                        var i = row.status==1 ? 'check' : 'times';
                        return `<button type="button" onclick="toggleStatus(this)" data-url="{{url('users/status')}}`+`/` + row.id + `" data-status="` + row.status + `" class="btn btn-` + btn +` btn-circle"><i class="fa fa-` + i + `"></i> </button>`;
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
            // html += '<a href="users/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="users/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
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