@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
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
                <form action="admin/tintuc/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Thể Loại</label>
                        <select class="form-control" name="TheLoai" id="TheLoai">
                            @foreach($theloai as $tl)
                                @if($tl->id == $tintuc->loaitin->theloai->id)
                                    <option value="{{$tl->id}}" selected>{{$tl->Ten}}</option>
                                @else
                                    <option value="{{$tl->id}}">{{$tl->Ten}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Loại Tin</label>
                        <select class="form-control" name="LoaiTin" id="LoaiTin">
                            @foreach($loaitin as $lt)
                                @if($lt->id == $tintuc->idLoaiTin)
                                    <option value="{{$lt->id}}" selected>{{$lt->Ten}}</option>
                                @else
                                    <option value="{{$lt->id}}">{{$lt->Ten}}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Tiêu Đề</label>
                        <input class="form-control" name="TieuDe" placeholder="Nhập tiêu đề" value="{{$tintuc->TieuDe}}"/>
                    </div>
                    <div class="form-group">
                        <label>Tóm Tắt</label>
                        <textarea id="demo" class="form-control ckeditor" rows="3" name="TomTat">{{$tintuc->TomTat}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Nội Dung</label>
                        <textarea id="demo2" class="form-control ckeditor" rows="5" name="NoiDung">{{$tintuc->NoiDung}}</textarea>
                    </div>
                    <div class="form-group">
                        <label>Hình Ảnh</label>
                        <img src="upload/tintuc/{{$tintuc->Hinh}}" width="400px"><br>
                        <input type="file" name="Hinh" class="form-control" id="hinh">
                    </div>
                    <div class="form-group">
                        <label>Nổi Bật</label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="1" 
                                @if($tintuc->NoiBat == 1) 
                                checked
                                @endif
                            type="radio">Có
                        </label>
                        <label class="radio-inline">
                            <input name="NoiBat" value="0"
                                @if($tintuc->NoiBat == 0) 
                                checked
                                @endif
                            type="radio">Không
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">Sửa</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                </form>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Comment
                    <small>Danh sách</small>
                </h1>
            </div>
            <!-- /.col-lg-12 -->
            @if(session('thongbao'))
                <div class="alert alert-success">
                    {{session('thongbao')}}
                </div>
            @endif
            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                <thead>
                    <tr align="center">
                        <th>ID</th>
                        <th>Người dùng</th>
                        <th>Nội Dung</th>
                        <th>Ngày Đăng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tintuc->comment as $cm)
                        <tr class="odd gradeX" align="center">
                            <td>{{$cm->id}}</td>
                            <td>{{$cm->user->name}}</td>
                            <td>{{$cm->NoiDung}}</td>
                            <td>{{$cm->created_at}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <form action="admin/tintuc/deleteComment/{{$cm->id}}/{{$tintuc->id}}" method="POST" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" name="" value="Xóa" style="border: none; background: none; color: #337ab7">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.container-fluid -->
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            var idTheLoai = $("#TheLoai").val();
            $.get("admin/tintuc/loaitinOptions/" + idTheLoai, function(data){
                $("#LoaiTin").html(data);
            });
            $("#TheLoai").change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/tintuc/loaitinOptions/" + idTheLoai, function(data){
                    $("#LoaiTin").html(data);
                });
            });
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