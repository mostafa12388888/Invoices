<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use App\models\section;
use Illuminate\Http\Request;

class customer_Repot extends Controller
{
    public function __construct()
    {
        $this->middleware(['status']);
        $this->middleware('permission:تقرير العملاء',['only'=>['index','Search_customers']]);
    }
    public function index(){
$sections_data=section::all();
return  view('reports.customer_Repot',compact('sections_data'));
    }
    public function Search_customers(Request $request){
$section_select=$request->Section;
$product_select=$request->product;
// return $request->product;
       if($request->Section && $request->product &&$request->start_at=='' && $request->end_at ==''){
        // return $request;
$data=invoices::where('section_id',$request->Section)->where('proudect',$request->product)->get();
$sections_data=section::all();
return  view('reports.customer_Repot',compact('product_select','section_select','sections_data'))->withDetails($data);
}else{
    $start_at=date($request->start_at);
    $end_at=date($request->end_at);
$data=invoices::whereBetween('due_date',[$start_at,$end_at])->where('section_id',$request->Section)->where('proudect',$request->product)->get();
$sections_data=section::all();
return  view('reports.customer_Repot',compact('product_select','section_select','start_at','end_at','sections_data'))->withDetails($data);
       
}}}
