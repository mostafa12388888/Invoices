<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\Models\inovice_attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ArctiveInvoicesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('permission:صلاحيات المستخدمين', ['only' => ['index']]);

        $this->middleware('permission:ارشيف الفواتير',['only'=>['index']]); 
        $this->middleware(['status']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_invoices=invoices::onlyTrashed()->get();
        return view('invoicesgroup.onlyarchive',compact('data_invoices'));
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
        //
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
        //
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
       
        invoices::withTrashed()->where('id',$request->invoice_id)->restore();
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data_delete=invoices::findOrfail($request->invoice_id);
        if($request->id_page==2){
            $data_delete->delete();
        }else{
            inovice_attachment::destroy($request->invoice_id);
            // public_path('file_attchment/'.$number.'/'.$name);
         storage::disk('publicinfo')->deleteDirectory('/'.$request->invoice_id);
         session()->flash('delete','تم حذف المرفق بنجاح');
        
            $data_delete->forceDelete();
        }
        session()->flash('delete');
        return back();
    }
}
