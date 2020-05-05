@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Slide
                    <small>Sửa</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            <div class="col-lg-7" style="padding-bottom:120px">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        @foreach($errors->all() as $err)
                            {{$err}}<br>
                        @endforeach
                    </div>
                @endif
                @if(session('thongbao'))
                    <div class="alert alert-success">
                        {{session('thongbao')}}
                    </div>
                @endif
                <form action="admin/slide/{{$slide->id}}" method="POST" enctype="multipart/form-data">     
                    @csrf
                    @method('PUT')           
                    <div class="form-group">
                        <label>Tên</label>
                        <input class="form-control" name="Ten" placeholder="Nhập tên" value="{{$slide->Ten}}"/>
                    </div>
                    <div class="form-group">
                        <label>Hình</label>
                        <img src="upload/slide/{{$slide->Hinh}}" width="400px"><br>
                        <input type="file" name="Hinh" class="form-control" id="hinh">
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <input class="form-control" name="NoiDung" placeholder="Nhập nội dung" value="{{$slide->NoiDung}}">
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input class="form-control" name="Link" placeholder="Nhập link" value="{{$slide->Link}}">
                    </div>
                    
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            $("#hinh").change(function (event) {                
                var fileName = $("#hinh").val().toString();
                var fileExtension = fileName.substring(fileName.length - 3, fileName.length).toLowerCase();
                if(fileExtension != 'png' && fileExtension != 'jpg' && fileExtension != 'peg') {
                    $("#hinh").val("");
                    alert("File không hợp lệ");
                }
            });
        });
    </script>
@endsection