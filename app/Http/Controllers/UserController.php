<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        return view('admin.user.index', ['user' => $user]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'Name' => 'bail|required|min:3',
                'Email' => 'bail|required|unique:Users,Email',
                'Password' => 'bail|required|min:3',
                'PasswordAgain' => 'bail|required|same:Password',
            ],

            [
                'Name.required' => 'Chưa nhập tên người dùng',
                'Name.min' => 'Tên người dùng phải có ít nhất 3 kí tự',
                'Email.required' => 'Chưa nhập email',
                'Email.email' => 'Chưa đúng định dạng email',
                'Email.unique' => 'Email đã tồn tại',
                'Password.required' => 'Chưa nhập mật khẩu',
                'Password.min' => 'Mật khẩu phải có ít nhất 3 kí tự',
                'PasswordAgain.required' => 'Chưa nhập lại mật khẩu',
                'PasswordAgain.same' => 'Mật khẩu nhập lại không khớp',
            ]
        );

        $user = new User;
        $user->name = $request->Name;
        $user->email = $request->Email;
        $user->level = $request->Level;
        $user->password = bcrypt($request->Password);
        $user->save();

        Session::flash('thongbao', 'Thêm thành công');
        return redirect('admin/user/create');//->with('thongbao', 'Thêm thành công');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'Name' => 'bail|required|min:3',
            ],

            [
                'Name.required' => 'Chưa nhập tên người dùng',
                'Name.min' => 'Tên người dùng phải có ít nhất 3 kí tự',
            ]
        );

        $user = User::find($id);
        $user->name = $request->Name;
        $user->level = $request->Level;
        if($request->changePassword == "on")
        {
            $request->validate(
                [
                    'Password' => 'bail|required|min:3',
                    'PasswordAgain' => 'bail|required|same:Password',
                ],

                [
                    'Password.required' => 'Chưa nhập mật khẩu',
                    'Password.min' => 'Mật khẩu phải có ít nhất 3 kí tự',
                    'PasswordAgain.required' => 'Chưa nhập lại mật khẩu',
                    'PasswordAgain.same' => 'Mật khẩu nhập lại không khớp',
                ]
            );
            $user->password = bcrypt($request->Password);
        }
        $user->save();

        Session::flash('thongbao', 'Đã sửa');
        return redirect('admin/user/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();
        Session::flash('thongbao', 'Đã xóa');
        return redirect('admin/user');
    }

    public function getLogin()
    {
        return view('admin.login');
    }

    public function postLogin(Request $request)
    {
        $this->validate($request,
            [
                'email' => 'required',
                'password' => 'required',
            ],
            [
                'email.required' => 'Chưa nhập email',
                'password.required' => 'Chưa nhập password',
            ]
        );
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password ]))
        {
            return redirect('admin/theloai');
        }
        else
        {
            Session::flash('thongbao', 'Sai tài khoản hoặc mật khẩu');
            return redirect('admin/login');
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect('admin/login');
    }
}
