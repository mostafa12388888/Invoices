<?php

namespace App\Http\Controllers;
use App\Models\invoices;
use Illuminate\Http\Request;

class Invoices_Report extends Controller
{
    public function __construct()
    {
        $this->middleware(['status']);
        $this->middleware('permission:تقرير الفواتير',['only'=>['index','Search_invoices']]);
    }
    public function index(){
        return view('reports.invoices_reports');
    }
    public function Search_invoices(Request $request){
// return $request;
if($request->rdio == 1){
    $type=$request->type;

if($request->type && $request->start_at=='' && $request->end_at ==''){
    // return $request;
$invoices=invoices::where('statues',$request->type)->get();
return view('reports.invoices_reports',compact('type'))->withDetails($invoices);
}else{
    $start_at=date($request->start_at);
$end_at=date($request->end_at);
$data=invoices::select('*')->whereBetween('due_date',[$start_at,$end_at])->where('statues',$request->type)->get();
return view('reports.invoices_reports',compact('type','start_at','end_at'))->withDetails($data);
}

}else{
    $data=invoices::select('*')->where('invoice_number',$request->invoice_number)->get();
    $invoice_number=$request->invoice_number;
    return view('reports.invoices_reports',compact('invoice_number'))->withDetails($data);
}
    }
}
