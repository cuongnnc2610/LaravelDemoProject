<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LoaiTin;
use App\TheLoai;
use App\TinTuc;
use App\Comment;
use Session;
use Illuminate\Support\Str;

class TinTucController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tintuc = TinTuc::orderBy('id', 'DESC')->get();
        return view('admin.tintuc.index', ['tintuc' => $tintuc]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $theloai = TheLoai::all();
        $loaitin = LoaiTin::all();
        return view('admin.tintuc.create', ['theloai' => $theloai, 'loaitin' => $loaitin]);
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
                'LoaiTin' => 'required',
                'TieuDe' => 'bail|required|unique:TinTuc,TieuDe|min:3',
                'TomTat' => 'required',
                'NoiDung' => 'required',
            ],

            [
                'TheLoai.required' => 'Chưa chọn thể loại',
                'LoaiTin.required' => 'Chưa chọn loại tin',
                'TieuDe.required' => 'Chưa nhập tiêu đề',
                'TieuDe.unique' => 'Tiêu đề đã tồn tại',
                'TieuDe.min' => 'Tiêu đề phải có ít nhất 3 kí tự',
                'TomTat.required' => 'Chưa nhập tóm tắt',
                'NoiDung.required' => 'Chưa nhập nội dung',
            ]
        );

        $tintuc = new TinTuc;
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;
        if($request->hasFile("Hinh"))
        {
            $file = $request->file('Hinh');
            $originalName = $file->getClientOriginalName();
            $fileName = Str::random(20). "_" . $originalName;
            while(file_exists("upload/tintuc/" .$fileName))
            {
                $fileName = Str::random(20). "_" . $originalName;
            }
            $file->move("upload/tintuc", $fileName);
            $tintuc->Hinh = $fileName;
        }
        else
        {
           $tintuc->Hinh = ""; 
        }
        $tintuc->save();

        Session::flash('thongbao', 'Thêm thành công');
        return redirect('admin/tintuc/create');//->with('thongbao', 'Thêm thành công');
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
        $loaitin = LoaiTin::all();
        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.edit', ['tintuc' => $tintuc, 'theloai' => $theloai, 'loaitin' => $loaitin]);
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
                'LoaiTin' => 'required',
                'TieuDe' => 'bail|required|unique:TinTuc,TieuDe,'. $id .'|min:3',
                'TomTat' => 'required',
                'NoiDung' => 'required',
            ],

            [
                'TheLoai.required' => 'Chưa chọn thể loại',
                'LoaiTin.required' => 'Chưa chọn loại tin',
                'TieuDe.required' => 'Chưa nhập tiêu đề',
                'TieuDe.unique' => 'Tiêu đề đã tồn tại',
                'TieuDe.min' => 'Tiêu đề phải có ít nhất 3 kí tự',
                'TomTat.required' => 'Chưa nhập tóm tắt',
                'NoiDung.required' => 'Chưa nhập nội dung',
            ]
        );

        $tintuc = TinTuc::find($id);
        $tintuc->TieuDe = $request->TieuDe;
        $tintuc->TieuDeKhongDau = changeTitle($request->TieuDe);
        $tintuc->TomTat = $request->TomTat;
        $tintuc->NoiDung = $request->NoiDung;
        $tintuc->idLoaiTin = $request->LoaiTin;
        $tintuc->NoiBat = $request->NoiBat;
        $tintuc->SoLuotXem = 0;
        if($request->hasFile("Hinh"))
        {
            $file = $request->file('Hinh');
            $originalName = $file->getClientOriginalName();
            $fileName = Str::random(20). "_" . $originalName;
            while(file_exists("upload/tintuc/" .$fileName))
            {
                $fileName = Str::random(20). "_" . $originalName;
            }
            $file->move("upload/tintuc", $fileName);
            if($tintuc->Hinh)
            {
                unlink("upload/tintuc/". $tintuc->Hinh);
            }
            $tintuc->Hinh = $fileName;
        }
        $tintuc->save();

        Session::flash('thongbao', 'Đã sửa');
        return redirect('admin/tintuc/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tintuc = TinTuc::find($id);
        if($tintuc->Hinh)
        {
            //unlink('upload/tintuc/'. $tintuc->Hinh);
        }
        //$tintuc->comment()->delete();
        $tintuc->delete();
        Session::flash('thongbao', 'Đã xóa tin tức');
        return redirect('admin/tintuc');
    }

    public function loaitinOptions($idTheLoai)
    {
        $loaitin = LoaiTin::where('idTheLoai', $idTheLoai)->get();
        foreach ($loaitin as $lt) 
        {
            echo '<option value=' .$lt->id. '>' .$lt->Ten. '</option>';
        }
    }

    public function deleteComment($idComment, $idTinTuc)
    {
        $comment = Comment::find($idComment);
        $comment->delete();
        Session::flash('thongbao', 'Đã xóa comment');
        return redirect('admin/tintuc/'.$idTinTuc.'/edit');
    }
}
