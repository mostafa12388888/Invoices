<?php

namespace App\Http\Controllers;

use App\Models\inovice_attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
class InoviceAttachmentController extends Controller
{
    public function __construct()
    {
        $this->middleware(['status']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'file_name'=>'required|mimes:pdf,jpg,jpeg,png'
        ],[
            'file_name.mimes'=>'صيغ المرفق يجب ان تكون* pdf,jpg,jpeg,png',
            'file_name.required'=>'قم بادخال الملف اولا',
        ]);
        
        $name_file=$request->file('file_name')->getClientOriginalName();
        
    inovice_attachment::create([
        'file_name'=>$name_file,
        'invoice_number'=>$request->invoice_number,
        'invoice_id'=>$request->invoice_id,
        'created_by'=>auth::user()->name,
    ]);
        // $store=new inovice_attachment();
        // $store->file_name=$name_file;
        // $store->invoice_number=$request->invoice_number;
        // $store->invoice_id=$request->invoice_id;
        // $store->created_by=auth::user()->name;
        // $store->save;
$b=$request->file_name->getClientOriginalName();
$request->file_name->move(public_path('file_attchment/'.$request->invoice_id),$b);
session()->flash('add','تم اضافه المرفق بنجاح');

return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\inovice_attachment  $inovice_attachment
     * @return \Illuminate\Http\Response
     */
    public function show(inovice_attachment $inovice_attachment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\inovice_attachment  $inovice_attachment
     * @return \Illuminate\Http\Response
     */
    public function edit(inovice_attachment $inovice_attachment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\inovice_attachment  $inovice_attachment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, inovice_attachment $inovice_attachment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\inovice_attachment  $inovice_attachment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        inovice_attachment::destroy($request->file_id);
        // public_path('file_attchment/'.$number.'/'.$name);
     storage::disk('publicinfo')->delete('/'.$request->file_id.'/'.$request->file_name);
     session()->flash('delete','تم حذف المرفق بنجاح');
     return back();
    }
}
