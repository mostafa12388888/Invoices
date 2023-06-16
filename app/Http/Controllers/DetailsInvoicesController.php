<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\Models\details_Invoices;
use App\Models\inovice_attachment;
use App\Models\invoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;



class DetailsInvoicesController extends Controller
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
    public function index($id)
    {
        $data_attachment=inovice_attachment::where('invoice_id',$id)->get();
        // return $data_attachment;
        $data_invoices=invoices::all()->where('id',$id)->first();
        // return $data_invoices;
       $data_details=details_Invoices::all()->where('id_Invoice',$id);
    //    return $data_details;
    $readNotification=DB::table('notifications')->where('data->id',$id)->pluck('id');
    // $readNotification=$readNotification->where("data['id']",$id);

    //  return $readNotification;
DB::table('notifications')->where('id',$readNotification[0])->update(['read_at' => now()]); 

        return view('invoicesgroup.details_invoices',compact('data_details','data_attachment','data_invoices'));
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
     * @param  \App\Models\details_Invoices  $details_Invoices
     * @return \Illuminate\Http\Response
     */
    public function show(details_Invoices $details_Invoices)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\details_Invoices  $details_Invoices
     * @return \Illuminate\Http\Response
     */
    public function edit(details_Invoices $details_Invoices)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\details_Invoices  $details_Invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, details_Invoices $details_Invoices)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\details_Invoices  $details_Invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(details_Invoices $details_Invoices)
    {
        //
    }
    public function downloaded($number,$name){
$dx=public_path('file_attchment/'.$number.'/'.$name);
// $dx=storage::disk('publicinfo')->getDriver()->getAdapter()->getPathPrefix($number.'/'.$name);
return response()->download($dx);
    }
    public function shown($number,$name){
        
        $x=public_path('file_attchment/'.$number.'/'.$name);
        // $x=storage::disk('publicinfo')->getDriver()->getAdapter()->getPathPrefix($number.'/'.$name);
        return response()->file($x);
    }
}
