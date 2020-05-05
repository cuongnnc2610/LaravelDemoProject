<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use Session;

class LoaiTinController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loaitin = LoaiTin::all();
        return view('admin.loaitin.index', ['loaitin' => $loaitin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = TheLoai::all();
        return view('admin.loaitin.create', ['theloai' => $theloai]);
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
                'TheLoai' => 'required',
                'Ten' => 'bail|required|unique:LoaiTin,Ten|min:1|max:100',
            ],

            [
                'TheLoai.required' => 'Chưa chọn thể loại',
                'Ten.required' => 'Chưa nhập tên loại tin',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
                'Ten.min' => 'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
                'Ten.max' => 'Tên loại tin phải có độ dài từ 1 đến 100 kí tự'
            ]
        );

        $loaitin = new LoaiTin;
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        Session::flash('thongbao', 'Thêm thành công');
        return redirect('admin/loaitin/create');//->with('thongbao', 'Thêm thành công');
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
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::find($id);
        return view('admin.loaitin.edit', ['loaitin' => $loaitin, 'theloai' => $theloai]);
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
                'TheLoai' => 'required',
                'Ten' => 'bail|required|unique:LoaiTin,Ten,'. $id .'|min:1|max:100',
            ],

            [
                'TheLoai.required' => 'Chưa chọn thể loại',
                'Ten.required' => 'Chưa nhập tên loại tin',
                'Ten.unique' => 'Tên loại tin đã tồn tại',
                'Ten.min' => 'Tên loại tin phải có độ dài từ 1 đến 100 kí tự',
                'Ten.max' => 'Tên loại tin phải có độ dài từ 1 đến 100 kí tự'
            ]
        );

        $loaitin = LoaiTin::find($id);
        $loaitin->Ten = $request->Ten;
        $loaitin->TenKhongDau = changeTitle($request->Ten);
        $loaitin->idTheLoai = $request->TheLoai;
        $loaitin->save();

        Session::flash('thongbao', 'Đã sửa');
        return redirect('admin/loaitin/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loaitin = LoaiTin::find($id);
        //$loaitin->tintuc()->comment()->delete();
        //$loaitin->tintuc()->delete();
        $loaitin->delete();
        Session::flash('thongbao', 'Đã xóa');
        return redirect('admin/loaitin');
    }
}
