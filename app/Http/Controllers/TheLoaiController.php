<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use Session;

class TheLoaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $theloai = TheLoai::all();
        return view('admin.theloai.index', ['theloai' => $theloai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.theloai.create');
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
                'Ten' => 'bail|required|unique:TheLoai,Ten|min:3|max:100',
            ],

            [
                'Ten.required' => 'Chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự'
            ]
        );

        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        Session::flash('thongbao', 'Thêm thành công');
        return redirect('admin/theloai/create');//->with('thongbao', 'Thêm thành công');
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
        $theloai = TheLoai::find($id);
        return view('admin.theloai.edit', ['theloai' => $theloai]);
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
                'Ten' => 'bail|required|unique:TheLoai,Ten,'. $id .'|min:3|max:100',
            ],

            [
                'Ten.required' => 'Chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự',
                'Ten.max' => 'Tên thể loại phải có độ dài từ 3 đến 100 kí tự'
            ]
        );

        $theloai = TheLoai::find($id);
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = changeTitle($request->Ten);
        $theloai->save();

        Session::flash('thongbao', 'Đã sửa');
        return redirect('admin/theloai/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $theloai = TheLoai::find($id);
        //$theloai->loaitin()->tintuc()->comment()->delete();
        //$theloai->loaitin()->tintuc()->delete();
        //$theloai->loaitin()->delete();
        $theloai->delete();
        Session::flash('thongbao', 'Đã xóa');
        return redirect('admin/theloai');
    }
}
