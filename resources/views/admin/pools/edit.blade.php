@extends($layout)

@push('link')

@endpush

@section('box')

    <!-- box-header -->
    <div class="box-header ">
    </div>
    <!-- /.box-header -->
    <!-- form start -->
    <form class="form-horizontal" method="POST" action="{{route('pools.update',[$pool['id']])}}">

        {{ csrf_field() }}
        {{ method_field('PATCH')}}

        <div class="box-body">

            <div class="form-group {{ $errors->has('subject_id') ? ' has-error' : '' }}">
                <label for="permission" class="col-md-2 control-label">选择科目</label>
                <div class="col-md-9">

                    {{-- Select2 插件 --}}
                    @include('layouts.plugins.Select2',['name'=>'subject_id','options'=>$subjects,'selected'=> $pool['subject_id'] ?? old('subject_id')])

                    @if ($errors->has('subject_id'))
                        <span class="help-block">{{$errors->first('subject_id')}}</span>
                    @endif

                </div>
            </div>

            <div class="form-group {{ $errors->has('sn') ? ' has-error' : '' }}">
                <label for="email" class="col-sm-2 control-label">题号</label>

                <div class="col-sm-9">
                    <input id="sn" name="sn" class="form-control" value="{{$pool['sn'] or old('sn') }}" placeholder="题号">
                    @if ($errors->has('sn'))
                        <span class="help-block">
                        <strong>{{ $errors->first('sn') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('question') ? ' has-error' : '' }}">
                <label for="name" class="col-sm-2 control-label">题目</label>

                <div class="col-sm-9">
                    <input id="question" type="text" name="question" class="form-control" value="{{$pool['question'] or old('question') }}" placeholder="题目" required>
                    @if ($errors->has('question'))
                        <span class="help-block">
                        <strong>{{ $errors->first('question') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group {{ $errors->has('answers') ? ' has-error' : '' }}">
                <label for="phone" class="col-sm-2 control-label">答案</label>

                <div class="col-sm-9">
                    @include('layouts.plugins.CK-Editor',['name'=>'answers','placeholder'=>$pool['answers']??old('answers')])
                    @if ($errors->has('answers'))
                        <span class="help-block">
                        <strong>{{ $errors->first('answers') }}</strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label class="col-sm-2 control-label">状态</label>
                <div class="col-sm-9">

                    {{-- Switchery 开关插件 --}}
                    @include('layouts.plugins.Switchery',['name'=>'status','checked'=>$pool['status']])

                </div>
            </div>


            <!-- /.form-group -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
            <button type="submit" class="btn btn-default">取消</button>
            <button type="submit" class="btn btn-info pull-right">提交</button>
        </div>
        <!-- /.box-footer -->
    </form>

@endsection
