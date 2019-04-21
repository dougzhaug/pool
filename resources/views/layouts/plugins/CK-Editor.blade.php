

    <textarea id="ck-{{$name}}" name="{{$name}}" rows="10" cols="80">
        {{$placeholder or ''}}
    </textarea>

@push('script')
    <!-- CK Editor -->
    <script src="{{admin_asset('bower_components/ckeditor/ckeditor.js')}}"></script>
    <script>
        $(function () {
            // instance, using default configuration.
            CKEDITOR.replace('ck-{{$name}}')
        })
    </script>
@endpush