@extends('admin.layout.index')

@section('content')
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">User
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
                <form action="admin/user/{{$user->id}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label>Họ Tên</label>
                        <input class="form-control" name="Name" placeholder="Nhập tên người dùng" value="{{$user->name}}"/>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" class="form-control" name="Email" placeholder="Nhập email" value="{{$user->email}}" readonly="" />
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="changePassword" id="changePassword">
                        <label>Đổi Mật khẩu</label>
                        <input type="password" class="form-control password" name="Password" id="password" placeholder="Nhập mật khẩu cũ" disabled="" />
                    </div>
                    <div class="form-group">
                        <label>Nhập lại mật khẩu</label>
                        <input type="password" class="form-control password" name="PasswordAgain" id="passwordAgain" placeholder="Nhập lại mật khẩu" disabled="" />
                    </div>                    
                    <div class="form-group">
                        <label>Quyền</label>
                        <label class="radio-inline">
                            <input name="Level" value="0"
                                @if($user->level == 0) 
                                checked
                                @endif
                            type="radio">Member
                        </label>
                        <label class="radio-inline">
                            <input name="Level" value="1"
                                @if($user->level == 1) 
                                checked
                                @endif
                            type="radio">Admin
                        </label>
                    </div>
                    <button type="submit" class="btn btn-default">User Edit</button>
                    <button type="reset" class="btn btn-default">Reset</button>
                <form>
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
            $("#changePassword").change(function(){
                if($(this).is(":checked"))
                {
                    $(".password").removeAttr("disabled");
                }
                else
                {
                    $(".password").attr("disabled", "");
                    $("#password").val("");
                    $("#passwordAgain").val("");
                }
            });
        });
    </script>
@endsection