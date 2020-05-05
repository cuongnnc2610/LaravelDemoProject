@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Loại tin
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
                        <th>Tên</th>
                        <th>Tên Không Dấu</th>
                        <th>Thể loại</th>
                        <th>Xóa</th>
                        <th>Sửa</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($loaitin as $lt)
                        <tr class="odd gradeX" align="center">
                            <td>{{$lt->id}}</td>
                            <td>{{$lt->Ten}}</td>
                            <td>{{$lt->TenKhongDau}}</td>
                            <td>{{$lt->theloai->Ten}}</td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <form action="admin/loaitin/{{$lt->id}}" method="POST" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" name="" value="Xóa" style="border: none; background: none; color: #337ab7">
                                </form>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/loaitin/{{$lt->id}}/edit">Sửa</a></td>
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