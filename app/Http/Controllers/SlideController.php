<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Slide;
use Session;
use Illuminate\Support\Str;

class SlideController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slide = Slide::all();
        return view('admin.slide.index', ['slide' => $slide]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
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
                'Ten' => 'bail|required|unique:Slide,Ten',
                'NoiDung' => 'required',
                'Link' => 'required',
                'Hinh' => 'required',
            ],

            [
                'Ten.required' => 'Chưa nhập tên',
                'Ten.unique' => 'Tên đã tồn tại',
                'NoiDung.required' => 'Chưa nhập nội dung',
                'Link.required' => 'Chưa nhập link',
                'Hinh.required' => 'Chưa upload ảnh',
            ]
        );

        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->Link = $request->Link;
        if($request->hasFile("Hinh"))
        {
            $file = $request->file('Hinh');
            $originalName = $file->getClientOriginalName();
            $fileName = Str::random(20). "_" . $originalName;
            while(file_exists("upload/slide/" .$fileName))
            {
                $fileName = Str::random(20). "_" . $originalName;
            }
            $file->move("upload/slide", $fileName);
            $slide->Hinh = $fileName;
        }
        else
        {
           $slide->Hinh = ""; 
        }
        $slide->save();

        Session::flash('thongbao', 'Thêm thành công');
        return redirect('admin/slide/create');//->with('thongbao', 'Thêm thành công');
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
        $slide = Slide::find($id);
        return view('admin.slide.edit', ['slide' => $slide]);
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
                'Ten' => 'bail|required|unique:Slide,Ten,'. $id,
                'NoiDung' => 'required',
                'Link' => 'required',
            ],

            [
                'Ten.required' => 'Chưa nhập tên',
                'Ten.unique' => 'Tên đã tồn tại',
                'NoiDung.required' => 'Chưa nhập nội dung',
                'Link.required' => 'Chưa nhập link',
            ]
        );

        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        $slide->Link = $request->Link;

        if($request->hasFile("Hinh"))
        {
            $file = $request->file('Hinh');
            $originalName = $file->getClientOriginalName();
            $fileName = Str::random(20). "_" . $originalName;
            while(file_exists("upload/slide/" .$fileName))
            {
                $fileName = Str::random(20). "_" . $originalName;
            }
            $file->move("upload/slide", $fileName);
            if($slide->Hinh)
            {
                unlink("upload/slide/". $slide->Hinh);
            }
            $slide->Hinh = $fileName;
        }
        
        $slide->save();

        Session::flash('thongbao', 'Đã sửa');
        return redirect('admin/slide/' . $id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slide = Slide::find($id);
        if($slide->Hinh)
        {
            unlink("upload/slide/". $slide->Hinh);
        }
        $slide->delete();
        Session::flash('thongbao', 'Đã xóa slide');
        return redirect('admin/slide');
    }
}
