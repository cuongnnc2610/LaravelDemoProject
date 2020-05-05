@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
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
                        <th>Email</th>
                        <th>Level</th>
                        <th>Xóa</th>
                        <th>Sửa</th>    
                    </tr>
                </thead>
                <tbody>
                    @foreach($user as $us)
                        <tr class="odd gradeX" align="center">
                            <td>{{$us->id}}</td>
                            <td>{{$us->name}}</td>
                            <td>{{$us->email}}</td>
                            <td>
                                @if($us->level == 1)
                                Admin
                                @else
                                Member
                                @endif
                            </td>
                            <td class="center"><i class="fa fa-trash-o  fa-fw"></i>
                                <form action="admin/user/{{$us->id}}" method="POST" style="display: inline-block;">
                                    @method('DELETE')
                                    @csrf
                                    <input type="submit" name="" value="Xóa" style="border: none; background: none; color: #337ab7">
                                </form>
                            </td>
                            <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/user/{{$us->id}}/edit">Sửa</a></td>
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