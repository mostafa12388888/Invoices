<?php

namespace App\Http\Controllers;

use App\Exports\invoicesExport;
use App\Models\details_Invoices;
use App\Models\inovice_attachment;
use App\Models\invoices;
use App\Models\section;
use App\Models\User;
use App\Notifications\AddInvoices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Exports\UsersExport;
use App\Notifications\Add_invoce;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Notifications\Notifiable;

class InvoicesController extends Controller
{
    use Notifiable;

    public function __construct()
    {
        $this->middleware(['status']);
        $this->middleware('permission:الفواتير',['only'=>['index']]);
        $this->middleware('permission:اضافة فاتورة',['only'=>['create']]);
        $this->middleware('permission:تغير حالة الدفع',['only'=>['show']]);
        $this->middleware('permission:تعديل الفاتورة',['only'=>['edit','update']]);
        $this->middleware('permission:طباعةالفاتورة',['only'=>['print_invoices']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_invoices=invoices::all();
       return view('invoicesgroup.invoices3',compact('data_invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sections_data=section::all();
        return view('invoicesgroup.addinvoices',compact('sections_data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'proudect'=>'required',
        //     'invoice_number'=>'required',
        //     'invoice_Date'=>'required',
        //     'Due_date'=>'required',
        //     'section'=>'required',
        //     'Amount_collection'=>'required',
        //     'Amount_Commission'=>'required',
        //     'Discount'=>'required',
        //     'Value_VAT'=>'required',
        //     'Rate_VAT'=>'required',
        //     'Total'=>'required',
        //     'note'=>'required',
        // ]);
        invoices::create([

            'invoice_number'=>$request->invoice_number,
            'invoices_date'=>date('Y/m/d', strtotime($request->invoice_Date)),
            'due_date'=>date('Y/m/d', strtotime($request->Due_date)),
            'proudect'=>$request->product,
            'section_id'=>$request->section,
            'amount_collection'=>$request->Amount_collection,
            'amount_comission'=>$request->Amount_Commission,
            'discount'=>$request->Discount,
            'value_vate'=>$request->Value_VAT,
           
            'rate_vat'=>$request->Rate_VAT,
            'total'=>$request->Total,
            'statues'=>'غيرمدفوع',
            'user'=>auth::user()->name,
            'value_status'=>2,
            'note'=>$request->note,
        ]);
        // return $request;
       $invoicce_id= invoices::latest()->first()->id;
        details_Invoices::create([
            'id_Invoice'=>invoices::latest()->first()->id,
        'invoice_number'=>$request->invoice_number,
        'product'=>$request->product,
        'section'=>$request->section,
        'status'=>'غيرمدفوع',
        'value_status'=>2,
        'note'=>$request->note,
        'user'=>Auth::user()->name,
        ]);
        if($request->hasFile('pic')){
            $inv=invoices::latest()->first()->id;
            $this->validate($request,[
                'pic' => 'required|mimes:png,pdf,jpg,jpeg|max:9999999',
            ],['pic.mimes'=>'خطاء في الحفظ']);
           $file_name=$request->file('pic')->getClientOriginalName();
           $attche=new inovice_attachment();
           $attche->file_name=$file_name;
           $attche->invoice_number=$request->invoice_number;
           $attche->created_by=auth::user()->name;
           $attche->invoice_id=$inv;
           $attche->save();
           $request->pic->move(public_path('file_attchment/'.$inv),$request->pic->getClientOriginalName());

        };
        $invoices1=invoices::latest()->first()->id;
        // $u=User::first();
        $rr=auth::user()->name;
      $user=User::where('name',$rr)->get();
        // $u->notify(new AddInvoices($invoicce_id));
        Notification::send($user,new AddInvoices($invoicce_id));
        Notification::send($user,new Add_invoce($invoices1));
       session()->flash('add','تم اضافه البينات بنجاح');
        return back();
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $invoices_data=invoices::where('id',$id)->first();
        
        return view('invoicesgroup.status_of_invoices',compact('invoices_data'));

        
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=invoices::where('id',$id)->first();
        $sections_data=section::all();
       return view('invoicesgroup.edit_invoices',compact('data','sections_data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
       $data=invoices::findOrfail($id);
       $data->update([
        'invoice_number'=>$request->invoice_number,
        'invoices_date'=>date('Y/m/d', strtotime($request->invoice_Date)),
        'due_date'=>date('Y/m/d', strtotime($request->Due_date)),
        'proudect'=>$request->product,
        'section_id'=>$request->section,
        'amount_collection'=>$request->Amount_collection,
        'amount_comission'=>$request->Amount_Commission,
        'discount'=>$request->Discount,
        'value_vate'=>$request->Value_VAT,
       
        'rate_vat'=>$request->Rate_VAT,
        'total'=>$request->Total,
       
        'user'=>auth::user()->name,
       
        'note'=>$request->note,
       ]);
       session()->flash('update','تم عمليه التعديل بنجاح');
       return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        // return $request;
        $delete=invoices::all()->where('id',$request->invoice_id)->first();
       $in=inovice_attachment::where('invoice_id',$request->invoice_id);
       inovice_attachment::destroy($request->invoice_id);
       // public_path('file_attchment/'.$number.'/'.$name);
    storage::disk('publicinfo')->deleteDirectory('/'.$request->invoice_id);
    session()->flash('delete','تم حذف المرفق بنجاح');
   
       $in->delete();
        $delete->forcedelete();
        session()->flash('delete');
    //   invoices::destroy($request->id);
      return back();
    }
    public function getproudects($id){
        $data = DB::table('products')->where('section_id',$id)->pluck('product_name','id');
        return json_encode($data );
    }
    public function status_update(Request $request){
        // return $request;
        $request->validate([
            'status'=>'required',
            'payment_date'=>'required',
        ]);
        // return $request->payment_date;
        if(!empty($request)){
        if($request->status=='مدفوعه'){
        $invo=invoices::findOrfail($request->id);
        $invo->update([
            
            'value_status'=>1,
            'statues'=>$request->status,
            'paymetn_date'=>date('Y-m-d', intval($request->payment_date)),
        ]);
        details_Invoices::create([
        'id_Invoice'=>$request->id,
        'invoice_number'=>$request->invoice_number,
        'product'=>$request->product,
        'section'=>$request->Section,
        'status'=>$request->status,
        'value_status'=>1,
        'note'=>$request->note,
        'payment_date'=>date('Y-m-d',intval($request->payment_date)),
        'user'=>Auth::user()->name,
        ]);}else if( $request->status=='مدفوعه جذاء منه'){
            $request->validate(['paid_cash'=>'required']);
            $v=$request->Amount_collection - $request->paid_cash ;
            $invo=invoices::findOrfail($request->id);
            $invo->update([
                'amount_collection'=>$v,
                'value_status'=>3,
                'statues'=>$request->status,
                'paymetn_date'=>date('Y-m-d', intval($request->payment_date)),
            ]);
            details_Invoices::create([
            'id_Invoice'=>$request->id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section'=>$request->Section,
            'status'=>$request->status,
            'value_status'=>3,
            'note'=>$request->note,
            'payment_date'=>date('Y-m-d',intval($request->payment_date)),
            'user'=>Auth::user()->name,
            ]);
        }else{
            $invo=invoices::findOrfail($request->id);
            $invo->update([
                
                'value_status'=>2,
                'statues'=>$request->status,
                'paymetn_date'=>date('Y-m-d', intval($request->payment_date)),
            ]);
            details_Invoices::create([
            'id_Invoice'=>$request->id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section'=>$request->Section,
            'status'=>$request->status,
            'value_status'=>2,
            'note'=>$request->note,
            'payment_date'=>date('Y-m-d',intval($request->payment_date)),
            'user'=>Auth::user()->name,
            ]);
        }
    
    }
        return redirect('invoicesgroup');

    }
    public function invoicespaid(){
$data_invoices=invoices::where('value_status',1)->get();
return view('invoicesgroup.onlyinvoices',compact('data_invoices'));
    }
    public function invoicesnotpaid(){
$data_invoices=invoices::where('value_status',2)->get();
return view('invoicesgroup.onlyinvoices',compact('data_invoices'));
    }
    public function invoicespicepaid(){
$data_invoices=invoices::where('value_status',3)->get();
return view('invoicesgroup.onlyinvoices',compact('data_invoices'));
    }
    public function print_invoices($id){
        $invoices=invoices::where('id',$id)->first();
        return view('invoicesgroup/print_invoices',compact('invoices'));
}
public function export() {
    
    return Excel::download(new invoicesExport,'invoices.xlsx');
}
public function markAsread(){
    $readNotification=auth()->user()->unreadNotifications;
if($readNotification){
    $readNotification->markAsread();
    
}
return back();
}
}
