@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
@endsection
@section('page-header')
<!-- breadcrumb -->
<div class="breadcrumb-header justify-content-between">
    <div class="my-auto">
        <div class="d-flex">
            <h4 class="content-title mb-0 my-auto">تفاصيل</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ المرفقات</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
@if(session()->has('delete'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{session()->get('delete')}}</strong>
    <button class="close" type="button" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if(session()->has('add'))
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong> {{session()->get('add')}}</strong>
    <button class="close" type="button" data-dismiss="alert" aria-label="close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <ul>
        @foreach($errors->all() as $error)
        <tr>
        <li>{{$error}}</li></tr>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" ><span aria-hidden="true">&times;</span></button>
    
</div>

@endif
<div class="row">

    <div class="col-lg-12 col-md-12">
        <div class="card" id="basic-alert">
            <div class="card-body">
                <div>

                </div>
                <div class="text-wrap">
                    <div class="example">
                        <div class="panel panel-primary tabs-style-1">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li class="nav-item"><a href="#tab1" class="nav-link active" data-toggle="tab">معلومات الفتوره</a></li>
                                        <li class="nav-item"><a href="#tab2" class="nav-link" data-toggle="tab">التفاصيل</a></li>
                                        <li class="nav-item"><a href="#tab3" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                    </ul>
                                </div>

                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab1">

                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <table class="table text-md-nowrap" id="example1">
                                                    <thead>
                                                        <tr>

                                                            <th class="wd-15p border-bottom-0">رقم الفاتوره</th>
                                                            <td class="wd-15p border-bottom-0">{{$data_invoices->invoice_number}}</td>
                                                            <th class="wd-20p border-bottom-0">تاريخ الفاتوره</th>
                                                            <td class="wd-15p border-bottom-0">{{$data_invoices->invoices_date}}</td>
                                                            <th class="wd-15p border-bottom-0">تاريخ الاستحقاق</th>
                                                            <td class="wd-15p border-bottom-0">{{$data_invoices->due_date}}</td>

                                                            <th class="wd-10p border-bottom-0">المنتج</th>
                                                            <td class="wd-15p border-bottom-0">{{$data_invoices->proudect}}</td>




                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                        <tr style="background-color:darkgray">




                                                            <th class="wd-25p border-bottom-0">الخصم</th>
                                                            <td class="wd-25p border-bottom-0">{{$data_invoices->discount}}</td>

                                                            <th class="wd-25p border-bottom-0">نسبه الضريبه</th>
                                                            <td class="wd-25p border-bottom-0">{{$data_invoices->rate_vat}}</td>

                                                            <th class="wd-25p border-bottom-0">قيمه الضريبه</th>
                                                            <td class="wd-25p border-bottom-0">{{$data_invoices->value_vate}}</td>

                                                            <th class="wd-25p border-bottom-0">الاجمالي</th>
                                                            <td class="wd-25p border-bottom-0">{{$data_invoices->total}}</td>


                                                        </tr>
                                                        <tr>
                                                            <th class="wd-25p border-bottom-0">القصم</th>
                                                            <td class="wd-15p border-bottom-0">{{$data_invoices->section_name->section_name}}</td>

                                                            <th class="wd-25p border-bottom-0">تاريخ الاستحقاق</th>
                                                            <td class="wd-15p border-bottom-0">{{$data_invoices->amount_comission}}</td>
                                                            <th class="wd-25p border-bottom-0">الحاله</th>
                                                            @if($data_invoices->value_status==2)
                                                            <td style="color:red;">{{$data_invoices->statues}}</td>

                                                            @elseif($data_invoices->value_status==1)
                                                            <td style="color:blue;">{{$data_invoices->statues}}</td>

                                                            @else
                                                            <td style="color:cadetblue;">{{$data_invoices->statues}}</td>
                                                            @endif
                                                            <th class="wd-25p border-bottom-0">الملاحظات</th>



                                                            <td class="wd-25p border-bottom-0">{{$data_invoices->note}}</td>
                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="tab2">
                                        <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                            <div class="tab-content">

                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        <table class="table text-md-nowrap" id="example1">
                                                            <thead>
                                                                <tr class="border-bottom-0">

                                                                    <th class="wd-20p border-bottom-0">#</th>
                                                                    <th class="wd-20p border-bottom-0">رقم فاتوره الملف</th>
                                                                    <th class="wd-15p border-bottom-0"> العامل الذي قام بعمل الملف</th>
                                                                    <th class="wd-25p border-bottom-0">الحاله</th>
                                                                    <th class="wd-25p border-bottom-0">الملاحظات</th>
                                                                    <th class="wd-10p border-bottom-0">المنتج</th>
                                                                    <th class="wd-10p border-bottom-0">القصم</th>
                                                                    <th class="wd-10p border-bottom-0">تاريخ الاضافه</th>
                                                                    <th class="wd-10p border-bottom-0">تاريخ الدفع</th>



                                                                
                                                                
                                                            </thead>
                                                            <tbody>



                                                            </tr>
                                                                @php
                                                                $counter=0;
                                                                @endphp
                                                                @foreach($data_details as $v)
                                                                <tr style="background-color:darkgray">
                                                                    <td class="wd-20p border-bottom-0">{{++$counter}}</td>
                                                                    <td class="wd-20p border-bottom-0">{{ $v->invoice_number }}</td>
                                                                    <td class="wd-20p border-bottom-0">{{$v->user}}</td>

                                                                    @if($v->value_status==2)
                                                                    <td style="color:red;">{{$v->status}}</td>

                                                                    @elseif($v->value_status==1)
                                                                    <td style="color:blue;">{{$v->statues}}</td>

                                                                    @else
                                                                    <td style="color:cadetblue;">{{$v->statues}}</td>
                                                                    @endif



                                                                    <td class="wd-25p border-bottom-0">{{$v->note}}</td>
                                                                    <td class="wd-20p border-bottom-0">{{$v->product}}</td>
                                                                    <td class="wd-20p border-bottom-0">{{$v->section}}</td>
                                                                    <td class="wd-20p border-bottom-0">{{$v->created_at}}</td>
                                                                    <td class="wd-20p border-bottom-0">{{$v->payment_date}}</td>

                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                    <div class="tab-pane" id="tab3">
                                        @can( 'اضافة مرفق')
                                  <div class="card-body">
                                    <p class="text-danger">فقط  انواعpdf,jpg,png</p>
                                    <form action="{{route('delet_file.store')}}" method="post" enctype="multipart/form-data">
                                    @csrf   
                                    <div class="custom-file">
                                            <input type="hidden"name="invoice_number" value="{{$data_invoices->invoice_number}}">
                                          
                                            <label for="file_name"> اضف مرفق </label>
                                            <input type="file" class="custom-file-input" style="cursor:pointer;"  id="file_name"  name="file_name">
                                            <label for="file_name" class="custom-file-label"> حدد المرفق</label>
                                            <input type="hidden" name="invoice_id" value="{{$data_invoices->id}}">
                                           
                                        </div>
                                        <br>
                                        <br>
                                        <button type="submit" class="btn btn-primary btn-sm">تاكيد</button>
                                    </form>
                                  </div>
                                  @endcan
                                        <div class="panel-body tabs-menu-body main-content-body-right border-top-0 border">
                                            <div class="tab-content">
                                           
                                                <div class="card-body">
                                                    <div class="table-responsive">
                                                        
                                                        <table class="table text-md-nowrap" id="example1">
                                                            <thead>
                                                                <tr class="border-bottom-0">

                                                                    <th class="wd-20p border-bottom-0">م</th>
                                                                    <th class="wd-20p border-bottom-0">اسم الملف</th>
                                                                    <th class="wd-15p border-bottom-0">الذي قام بعمل الاضافه</th>
                                                                    <th class="wd-25p border-bottom-0">تاريخ الاضافه</th>
                                                                    <th class="wd-25p border-bottom-0" style="text-align:center;">العمليات</th>




                                                                </tr>
                                                               
                                                            </thead>
                                                            <tbody>



                                                            @php
                                                                $counter=0;
                                                                @endphp
                                                                @foreach($data_attachment as $x)
                                                                <tr style="background-color:darkgray">
                                                                    <td class="wd-20p border-bottom-0">{{++$counter}}</td>
                                                                    <td class="wd-20p border-bottom-0">{{ $x->file_name }}</td>
                                                                    <td class="wd-20p border-bottom-0">{{$x->created_by}}</td>




                                                                    <td >{{$x->created_at}}</td>
                                                                    <td class="d-flex">
                                                                        <a href="/show/{{$x->invoice_id}}/{{$x->file_name}}" class="btn btn-outline-success btn-sm" role="button"> <i class="fas fa-eye"></i>&nbsp;تحميل</a>
                                                                        <a href="/download/{{$x->invoice_id}}/{{$x->file_name}}" class="btn btn-outline-info btn-sm" role="button"> <i class="fas fa-download"></i>&nbsp;تنزيل</a>
                                                                        @can('حذف المرفق')
                                                                        <button class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#modaldemo999" data-file_name="{{$x->file_name}}" data-id_file="{{$x->id}}" data-file_number="{{$x->invoice_number}}">حذف</button>
@endcan
                                                                        
                                                                    </td>

                                                                </tr>
                                                                @endforeach

                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="modal fade" id="modaldemo999" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{route('delet_file.destroy',9)}}" method="post">
                        {{ method_field('delete') }}
                        @csrf
                        <div class="modal-body">
                            <p>هل انت متاكد من عملية الحذف ؟</p><br>
                            <input type="hidden" name="file_id" id="file_id" value="">
                            <input type="hidden" name="file_number" id="file_number" value="">
                            <input class="form-control" name="file_name" id="file_name" type="text" value="" readonly>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                            <button type="submit" class="btn btn-danger">تاكيد</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- row closed -->
    </div>




</div>
<!-- Container closed -->
</div>
<!-- main-content closed -->
@endsection
@section('js')
<script>
    $('button[data-target="#modaldemo999"]').on('click',function(){
        var name=document.querySelector('#file_name');
        var id=document.querySelector('#file_id');
        var number=document.querySelector('#file_number');
        name.value=this.getAttribute('data-file_name');
        id.value=this.getAttribute('data-id_file');
        number.value=this.getAttribute('data-file_number');
    })
</script>
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
@endsection