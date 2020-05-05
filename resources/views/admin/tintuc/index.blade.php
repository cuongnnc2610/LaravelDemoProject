@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Tin tức
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
                        <th>Tiêu Đề</th>
                        <th>Tóm Tắt</th>
                        <th>Nội Dung</th>
                        <th>Nổi Bật</th>
                        <th>Số Lượt Xem</th>
                        <th>Loại Tin</th>
                        <th>Thể Loại</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tintuc as $tt)
                        <tr class="odd gradeX" align="center">
                            <td>{{$tt->id}}</td>
                            <td>
                                <p>{{$tt->TieuDe}}</p>
                                <img src="upload/tintuc/{{$tt->Hinh}}" width="100px">
                            </td>
                            <td>{{$tt->TomTat}}</td>
                            <td>{{$tt->NoiDung}}</td>
                            <td>
                                @if($tt->NoiBat == 1)
                                Có
                                @else
                                Không
                                @endif
                            </td>
                            <td>{{$tt->SoLuotXem}}</td>
                            <td>{{$tt->loaitin->Ten}}</td>
                            <td>{{$tt->loaitin->theloai->Ten}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <form action="admin/tintuc/{{$tt->id}}" method="POST" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" name="" value="Xóa" style="border: none; background: none; color: #337ab7">
                                </form>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/tintuc/{{$tt->id}}/edit">Sửa</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
@endsection