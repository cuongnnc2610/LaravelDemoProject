@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Thể Loại
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
                        @can('update', App\TheLoai::class)
                        <th>Xóa</th>
                        @endcan
                        @can('delete', App\TheLoai::class)
                        <th>Sửa</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @foreach($theloai as $tl)
                        <tr class="odd gradeX" align="center">
                            <td>{{$tl->id}}</td>
                            <td>{{$tl->Ten}}</td>
                            <td>{{$tl->TenKhongDau}}</td>
                            @can('delete', App\TheLoai::class)
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <form action="admin/theloai/{{$tl->id}}" method="POST" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" name="" value="Xóa" style="border: none; background: none; color: #337ab7">
                                </form>
                            </td>
                            @endcan
                            @can('update', App\TheLoai::class)
                            <td class="center"><i class="fa fa-pencil fa-fw"></i><a href="admin/theloai/{{$tl->id}}/edit">Sửa</a></td>
                            @endcan
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