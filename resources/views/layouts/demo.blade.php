@extends($layout)

@section('box')
    <div style="display: flex; align-items:center;justify-content: center; flex-direction:column; width: 100%" >
        <h1 class="text-muted m-b-30 font-13"> 列表页面Demo </h1>
    </div>


    {{-- 列表页面Demo --}}
    <div class="box-header">
        <form id="formSearch" class="form-horizontal" method="POST" action="{{url('admin/index')}}">

            <div class="input-group margin search-input col-sm-3">
                @include('layouts.plugins.DropdownsInput',['name'=>'name','dropdowns'=>[['name'=>'名称','value'=>'name']]])
            </div>

            <div class="input-group margin search-input col-sm-3">
                @include('layouts.plugins.DropdownsInput',['name'=>'pid','dropdowns'=>[['name'=>'名称','value'=>'name'],['name'=>'联系电话','value'=>'phone']]])
            </div>

            <div class="input-group margin search-input col-sm-3">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">权限</button>
                </span>
                {{-- Select2 插件 --}}
                @include('layouts.plugins.Select2',['name'=>'pid','options'=>['足球'=>1,'篮球'=>3,'乒乓球'=>5],'selected'=>[5]])
            </div>

            <div class="input-group margin search-input col-sm-3">
                <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                </div>
                {{-- Daterangepicker 时间插件 --}}
                @include('layouts.plugins.Daterangepicker')
            </div>

            <div class="input-group margin search-input col-sm-3">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">交易时间</button>
                </span>
                {{-- Daterangepicker 时间插件 --}}
                @include('layouts.plugins.Daterangepicker')
            </div>

            <div class="input-group margin search-input col-sm-3">
                <div class="input-group">
                    {{-- Daterangepicker 时间插件 --}}
                    @include('layouts.plugins.Daterangepicker',['style'=>'btn'])
                </div>
            </div>

            <div class="input-group margin search-input col-sm-3">
                <span class="input-group-btn">
                    <button class="btn btn-info" type="button">范围</button>
                </span>
                <div class="input-group">
                    {{-- Daterangepicker 时间插件 --}}
                    @include('layouts.plugins.Daterangepicker',['style'=>'btn','placeholder'=>'请选择时间'])
                </div>
            </div>

            <div class="input-group margin search-input">
                <button type="button" onclick="doSearch()" id="searchBtn" class="btn btn-block btn-info" value="查询">查询</button>
            </div>
        </form>
    </div>

    <div class="box-label">
        <a href="{{url('admin/create')}}" class="btn btn-info">添加管理员</a>
    </div>

    <div class="box-body">
        <table id="data-tables" class="table table-bordered table-striped" data-url="{{url('admins')}}">
            <thead>
            <tr>
                <th data-name="id" data-sort="true">ID</th>
                <th data-name="name">姓名</th>
                <th data-name="phone">手机号码</th>
                <th data-name="email" data-sort="true" data-default-sort="desc">E-mail</th>
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
                <th>注册时间</th>
            </tr>
            </tfoot>
        </table>
    </div>

    {{-- 列表页面Demo(完) --}}

    <br><br>
    <div style="display: flex; align-items:center;justify-content: center; flex-direction:column; width: 100%" >
        <h1 class="text-muted m-b-30 font-13"> 表单页面Demo </h1>
    </div>

    <div class="box-header ">
    </div>
    {{-- 表单页面Demo --}}
    <form class="form-horizontal" action="{{url('test')}}">

        <div class="box-body">

            <div class="form-group">
                <label class="col-sm-2 control-label">下拉框</label>
                <div class="col-sm-9">

                    {{-- Select2 下拉插件 --}}
                    @include('layouts.plugins.Select2',['name'=>'pid','selected'=>5,'options'=>[['name'=>'篮球','value'=>3],['name'=>'足球','value'=>5],['name'=>'乒乓球','value'=>10]]])

                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">下拉框(多选)</label>
                <div class="col-sm-9">

                    {{-- Select2 下拉插件 --}}
                    @include('layouts.plugins.Select2',['name'=>'pid','selected'=>[3,5],'multiple'=>true,'options'=>[['name'=>'篮球','value'=>3],['name'=>'足球','value'=>5],['name'=>'乒乓球','value'=>10]]])

                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">开关</label>
                <div class="col-sm-9">

                    {{-- Switchery 开关插件 --}}
                    @include('layouts.plugins.Switchery',['name'=>'status','color'=>'red','checked'=>true])

                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">复选</label>
                <div class="col-sm-9">

                    {{-- Checkbox 复选框插件 --}}
                    @include('layouts.plugins.Checkbox',['name'=>'kkie1','checkbox'=>[['name'=>'篮球','value'=>1],['name'=>'足球','value'=>5,'checked'=>true,'disabled'=>1],['name'=>'乒乓球','value'=>3,'checked'=>true]]])

                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">复选(水平)</label>
                <div class="col-sm-9">

                    {{-- Checkbox 复选框插件 --}}
                    @include('layouts.plugins.Checkbox',['name'=>'kkie2','level'=>true,'checkbox'=>[['name'=>'篮球','value'=>1],['name'=>'足球','value'=>5,'checked'=>true,'disabled'=>1],['name'=>'乒乓球','value'=>3,'checked'=>true]]])

                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">单选</label>
                <div class="col-sm-9">

                    {{-- Radio 单选框插件 --}}
                    @include('layouts.plugins.Radio',['name'=>'kkie4','radio'=>[['name'=>'篮球','value'=>1],['name'=>'足球','value'=>5],['name'=>'乒乓球','value'=>3]]])

                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">单选(水平)</label>
                <div class="col-sm-9">

                    {{-- Radio 单选框插件 --}}
                    @include('layouts.plugins.Radio',['name'=>'kkie3','level'=>true,'radio'=>[['name'=>'篮球','value'=>1],['name'=>'足球','value'=>5],['name'=>'乒乓球','value'=>3]]])

                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">时间选择器1</label>
                <div class="col-sm-9">
                    {{-- Daterangepicker 时间插件 --}}
                    @include('layouts.plugins.Daterangepicker',['style'=>'single','opens'=>'left','value'=>'2018-12-20 12:02:22 ~ 2018-3-2'])
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">时间选择器2</label>
                <div class="col-sm-9">
                    {{-- Daterangepicker 时间插件 --}}
                    @include('layouts.plugins.Daterangepicker',['time_picker'=>'true','show_dropdowns'=>'false'])
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputuname" class="col-sm-2 control-label">时间选择器3</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        {{-- Daterangepicker 时间插件 --}}
                        @include('layouts.plugins.Daterangepicker',['style'=>'reservation-time'])
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="exampleInputuname" class="col-sm-2 control-label">时间选择器4</label>
                <div class="col-sm-9">
                    <div class="input-group">
                        <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                        {{-- Daterangepicker 时间插件 --}}
                        @include('layouts.plugins.Daterangepicker')
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">时间选择器5</label>
                <div class="col-sm-9">
                    {{-- Daterangepicker 时间插件 --}}
                    @include('layouts.plugins.Daterangepicker',['style'=>'btn','opens'=>'left'])
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">上传</label>
                <div class="col-sm-9">

                    {{-- 上传 --}}
                    @uploader('assets')
                    @uploader(['name' => 'avatar', 'max' => 100, 'accept' => 'jpg,png,gif,pdf,txt,csv','src'=>['2019-04-14/MBiGmZO7zFmWpRFBb6ACL7nbFzWyO32y3215uE5a.png']])
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">标签输入框</label>
                <div class="col-sm-9">
                    @include('layouts.plugins.TagsInput',['name'=>'tag','value'=>'角色,卡死了'])
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Username*</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="inputEmail1" placeholder="Username"> </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Email*</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="inputEmail2" placeholder="Email"> </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Website</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" id="inputEmail3" placeholder="Website"> </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Password*</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Password"> </div>
            </div>
            <div class="form-group">
                <label for="inputPassword4" class="col-sm-2 control-label">Re Password*</label>
                <div class="col-sm-9">
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Retype Password"> </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-9">
                    <div class="checkbox checkbox-success">
                        <input id="checkbox33" class="flat-red" type="checkbox">
                        <label for="checkbox33">Check me out !</label>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-default">取消</button>
            <button type="submit" class="btn btn-info pull-right">提交</button>
        </div>
        <!-- /.box-footer -->
    </form>

    {{-- 表单页面Demo(完) --}}
@endsection

@push('script')
    <script>
        /**
         * DataTables 初始化
         */
        var tables = DataTableLoad();


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
            html += '<a href="admin/'+data.id+'/edit" class="btn btn-info btn-xs tables-console tables-edit"><span class="glyphicon glyphicon-edit"></span>编辑</a>';
            html += '<button data-url="admin/'+data.id+'" onclick="tablesDelete(this)" class="btn btn-danger btn-xs tables-console tables-delete"><span class="glyphicon glyphicon-trash"></span>删除</button>';
            return html;
        }

    </script>
@endpush