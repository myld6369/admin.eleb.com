@extends('default')
@section('css_files')
    <link rel="stylesheet" type="text/css" href="/webuploader/webuploader.css">
@stop
@section('js_files')
    <script type="text/javascript" src="/webuploader/webuploader.js"></script>
@stop

@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>修改分类</h1>
        <form action="{{route('shops_categories.update',['shops_category'=>$shops_category])}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>分类名称</label>
                <input type="text" name="name" class="form-control" value="{{$shops_category->name}}">
            </div>
            <div>
                <label>是否显示: <input type="checkbox" name="status"  value="1" {{$shops_category->status==1?"checked":""}}></label>
            </div>
            <div class="form-group">
                <label>商品图片</label>
                <input type="hidden" id="img_url" name="img">
                <div id="uploader-demo">
                    <!--用来存放item-->
                    <div id="fileList" class="uploader-list"></div>
                    <div id="filePicker">选择图片</div>

                </div>
                <img src="{{$shops_category->img}}" id="img">
            </div>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <button class="btn btn-primary">提交</button>
        </form>
    </div>
@endsection
@section('js')
    <script>
        // 初始化Web Uploader
        var uploader = WebUploader.create({

            // 选完文件后，是否自动上传。
            auto: true,

            // swf文件路径
//            swf: BASE_URL + '/js/Uploader.swf',

            // 文件接收服务端。
            server: '{{route('upload')}}',

            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: '#filePicker',

            // 只允许选择图片文件。
            accept: {
                title: 'Images',
                extensions: 'gif,jpg,jpeg,bmp,png',
                mimeTypes: 'image/*'
            },
            formData:{
                _token:'{{csrf_token()}}'
            }
        });
        uploader.on('uploadSuccess',function(file,response){
            $('#img').attr('src',response.fileName);
            $('#img_url').val(response.fileName);
        });
    </script>
@stop