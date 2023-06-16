@extends('layouts.master')
@section('css')
    <!--- Internal Select2 css-->
    <link href="{{ URL::asset('assets/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    <!---Internal Fileupload css-->
    <link href="{{ URL::asset('assets/plugins/fileuploads/css/fileupload.css') }}" rel="stylesheet" type="text/css" />
    <!---Internal Fancy uploader css-->
    <link href="{{ URL::asset('assets/plugins/fancyuploder/fancy_fileupload.css') }}" rel="stylesheet" />
    <!--Internal Sumoselect css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/sumoselect/sumoselect-rtl.css') }}">
    <!--Internal  TelephoneInput css-->
    <link rel="stylesheet" href="{{ URL::asset('assets/plugins/telephoneinput/telephoneinput-rtl.css') }}">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ اضافه فاتوره</span>
						</div>
					</div>
				
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
				<!-- row -->
				<div class="row">

				<div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="/ststusInvoicesform" method="post" 
                        autocomplete="off">
                        {{ csrf_field() }}

                        {{-- 1 --}}

                        <div class="row">
                            <div class="col">
                                <input type="hidden"  name="id"value="{{$invoices_data->id}}">
                                <label for="inputName" class="control-label">رقم الفاتورة</label>
                                <input readonly type="text" class="form-control" id="inputName" value="{{$invoices_data->invoice_number}}" name="invoice_number"
                                    title="يرجي ادخال رقم الفاتورة" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الفاتورة</label>
                                <input readonly class="form-control fc-datepicker" name="invoice_Date" placeholder="YYYY-MM-DD"
                                    type="text" value="{{$invoices_data->invoices_date}}" required>
                            </div>

                            <div class="col">
                                <label>تاريخ الاستحقاق</label>
                                <input readonly class="form-control  fc-datepicker" value="{{$invoices_data->due_date}}"  name="Due_date" placeholder="YYYY-MM-DD"
                                    type="text" required>
                            </div>

                        </div>

                        {{-- 2 --}}
                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">القسم</label>
                                <select name="Section" class="form-control SlectBox" 
                                    >
                                    <!--placeholder-->
                                    <option readonly value="{{$invoices_data->section_id}}">{{$invoices_data->section_name->section_name}}</option>
                                   
                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">المنتج</label>
                                <select id="product" name="product" class="form-control">
                                <option readonly value="{{$invoices_data->proudect}}"   >{{$invoices_data->proudect}}</option>

                                </select>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ التحصيل</label>
                                <input type="text" class="form-control" value="{{$invoices_data->amount_collection}}" id="inputName" name="Amount_collection"
                                readonly  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>


                        {{-- 3 --}}

                        <div class="row">

                            <div class="col">
                                <label for="inputName" class="control-label">مبلغ العمولة</label>
                                <input readonly type="text" class="form-control form-control-lg" id="Amount_Commission"
                                    name="Amount_Commission" title="يرجي ادخال مبلغ العمولة " value="{{$invoices_data->amount_comission}}"
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الخصم</label>
                                <input  readonly type="text" class="form-control form-control-lg" id="Discount" name="Discount"
                                    title="يرجي ادخال مبلغ الخصم "
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    value="{{$invoices_data->discount}}" required>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select readonly name="Rate_VAT" id="Rate_VAT" class="form-control" >
                                    <!--placeholder-->
                                    <option readonly  value="{{$invoices_data->rate_vat}}" >{{$invoices_data->rate_vat}}</option>
                                    
                                </select>
                            </div>

                        </div>

                        {{-- 4 --}}

                        <div class="row">
                            <div class="col">
                                <label for="inputName" class="control-label">قيمة ضريبة القيمة المضافة</label>
                                <input type="text" readonly class="form-control" id="Value_VAT" value="{{$invoices_data->value_vate}}" name="Value_VAT" readonly>
                            </div>

                            <div class="col">
                                <label for="inputName" class="control-label">الاجمالي شامل الضريبة</label>
                                <input type="text" readonly class="form-control" id="Total" value="{{$invoices_data->total}}" name="Total" readonly>
                            </div>
                        </div>

                        {{-- 5 --}}
                        <div class="row">
                            <div class="col">
                                <label for="exampleTextarea">ملاحظات</label>
                                <textarea class="form-control" id="exampleTextarea" name="note" rows="3" readonly>{{$invoices_data->note}}</textarea>
                            </div>
                        </div><br>
                        <div class="row">
                            
                        <div class="col">
                                <label for="status" class="control-label">نسبة ضريبة القيمة المضافة</label>
                                <select name="status" id="status" class="form-control" >
                                    <!--placeholder-->
                                    <option  selected disabled>حداد حاله الدفع</option>
                                    <option  >غير مدفوعه</option>
                                    <option  value="مدفوعه جذاء منه" >مدفوعه جذاء منه </option>
                                    <option  >مدفوعه </option>
                                    
                                </select>
                            </div>
                            <div class="col">
                                <label for="payment_date" class="control-label ">تاريخ الدفع </label>
                                <input type="text" class="form-control fc-datepicker" id="payment_date" name="payment_date" value="{{ date('Y-m-d') }}"  >
                            </div>       
                            <div class="col" id="inputNam6">
                                <label for="inputNam6" class="control-label">ادخل الجذاء الذي تريد دفعه من المبلغ</label>
                                <input  type="text" class="form-control form-control-lg" style='border:1 solid black' id="inputNam6"
                                    name="paid_cash" title="ادخل المبلغ الذي تريد دفعه" value=""
                                    oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                                    >
                            </div>     
                        </div>  
                        <div style="display: flex;
  align-items:flex-end;
  justify-content: center">

    <button type="submit" class="btn btn-primary w-25" >تحديث حاله الدفع</button>
    </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

    </div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

<!-- js for the calclate -->
<script>
    $(function(){
        $('#inputNam6').hide();
        $('#status').on('change',function(){
            {
            if(this.value=='مدفوعه جذاء منه'){
                $('#inputNam6').show();
            }else{
                $('#inputNam6').hide();
            }
        }
        })
    })
  
    function addinput(){
        console.log("Mostafa")
       
        //     var amount_comation=parseFloat(document.getElementById('Amount_Commission').value);
        //     var discount=parseFloat(document.getElementById('Discount').value);
        //     var Rate_VAT=parseFloat(document.getElementById('Rate_VAT').value);
        //     if(amount_comation){
        //     if(amount_comation >= discount){
        //     var data=(amount_comation-discount)*Rate_VAT/100; 
        //     $('#Value_VAT').val(data);
        //     $('#Total').val(data+amount_comation);}
        //     else{
        //         alert('الخصم اكبر من العموله');
        //     }
        // }
        // else{
        //     alert("ادخل المبلغ المحدد في العموله من فضلك");
        // }

    }
        
    </script>
    <!-- Internal Select2 js-->
    <script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
    <!--Internal Fileuploads js-->
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fileuploads/js/file-upload.js') }}"></script>
    <!--Internal Fancy uploader js-->
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.ui.widget.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.iframe-transport.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/jquery.fancy-fileupload.js') }}"></script>
    <script src="{{ URL::asset('assets/plugins/fancyuploder/fancy-uploader.js') }}"></script>
    <!--Internal  Form-elements js-->
    <script src="{{ URL::asset('assets/js/advanced-form-elements.js') }}"></script>
    <script src="{{ URL::asset('assets/js/select2.js') }}"></script>
    <!--Internal Sumoselect js-->
    <script src="{{ URL::asset('assets/plugins/sumoselect/jquery.sumoselect.js') }}"></script>
    <!--Internal  Datepicker js -->
    <script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
    <!--Internal  jquery.maskedinput js -->
    <script src="{{ URL::asset('assets/plugins/jquery.maskedinput/jquery.maskedinput.js') }}"></script>
    <!--Internal  spectrum-colorpicker js -->
    <script src="{{ URL::asset('assets/plugins/spectrum-colorpicker/spectrum.js') }}"></script>
    <!-- Internal form-elements js -->
    <script src="{{ URL::asset('assets/js/form-elements.js') }}"></script>
   
@endsection