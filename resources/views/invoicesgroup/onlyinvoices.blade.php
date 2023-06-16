@extends('layouts.master')
@section('title')
قائمه الفواتير
@endsection
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/notify/css/notifIt.css')}}" rel="stylesheet"/>
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/قائمه الفواتير</span>
						</div>
					</div>
					<div class="d-flex my-xl-auto right-content">
						
						
					</div>
				</div>
				<!-- breadcrumb -->
@endsection
@section('content')

@if(session()->has('delete'))
<script>
window.onload=function(){
	notif({
		msg:'تم حذف الرساله بنجاح ',
		type:success,

	})
}
</script>
@endif
				<!-- row -->
				<div class="row">
                <div class="row row-sm">
					<div class="col-xl-12">
						<div class="card">
							<div class="card-header pb-0">
							@can('اضافة فاتورة')
								<a class="btn btn-primary" style="cursor: pointer;" href="invoicesgroup/create">اضافه فتوره</a>
								@endcan
														</div>
							<div class="card-body">
								<div class="table-responsive">
									<table class="table text-md-nowrap" id="example1">
										<thead>
											<tr>
												<th class="wd-15p border-bottom-0">#</th>
												<th class="wd-15p border-bottom-0">رقم الفاتوره</th>
												<th class="wd-20p border-bottom-0">تاريخ الفاتوره</th>
												<th class="wd-15p border-bottom-0">تاريخ الاستحقاق</th>
												<th class="wd-10p border-bottom-0">المنتج</th>
												<th class="wd-25p border-bottom-0">القصم</th>
												<th class="wd-25p border-bottom-0">تاريخ الاستحقاق</th>
												<th class="wd-25p border-bottom-0">الخصم</th>
												<th class="wd-25p border-bottom-0">نسبه الضريبه</th>
												<th class="wd-25p border-bottom-0">قيمه الضريبه</th>
												<th class="wd-25p border-bottom-0">الاجمالي</th>
												<th class="wd-25p border-bottom-0">الحاله</th>
												<th class="wd-25p border-bottom-0">الملاحظات</th>
												<th class="wd-25p border-bottom-0">العمليات</th>
											</tr>
										</thead>
										<tbody>
										@php
											$counter=0;
											@endphp
										@foreach($data_invoices as $value_invoices)
											<tr>
												
												<td>{{++$counter}}</td>
												<td>{{$value_invoices->invoice_number}}</td>
												<td>{{$value_invoices->invoices_date}}</td>
												<td>{{$value_invoices->due_date}}</td>
												<td>{{$value_invoices->proudect}}</td>
												<td><a href="/details-Invoices/{{$value_invoices->id}}" styl="text-dectionarty:none">{{$value_invoices->section_name->section_name}}</a></td>
												
												
												<td>{{$value_invoices->amount_comission}}</td>
												<td>{{$value_invoices->discount}}</td>
												<td>{{$value_invoices->rate_vat}}</td>
												<td>{{$value_invoices->value_vate}}</td>
												
												<td>{{$value_invoices->total}}</td>
												@if($value_invoices->value_status==2)
												<td style="color:red;">{{$value_invoices->statues}}</td>
												
												@elseif($value_invoices->value_status==1)
												<td style="color:blue;">{{$value_invoices->statues}}</td>
												
												@else
												<td style="color:cadetblue;">{{$value_invoices->statues}}</td>
												@endif
												<td>{{$value_invoices->note}}</td>
												<td><div class="dropdown">
	<button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary"
	data-toggle="dropdown" type="button"><span style="display: flex;"> العمليات <i class="fas fa-caret-down ml-1"></i></span></button>
	<div class="dropdown-menu tx-13">
		@can('تعديل الفاتورة')
		<a class="dropdown-item" href="edit_invoice/{{$value_invoices->id}}">تعديل الفاطوره</a>
		@endcan
		@can('حذف الفاتورة')
		<a class="dropdown-item delete_invoice_and_retrivel" href="#" data-invoice_id="{{ $value_invoices->id }}" 
                                                            data-toggle="modal" data-target="#delete_invoice"><i
                                                                class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                            الفاتورة</a>
															@endcan
															@can('تغير حالة الدفع')
		<a class="dropdown-item delete_invoice_and_retrivel" href="/ststusInvoices/{{$value_invoices->id}}"><i
        class="text-success fas  fa-money-bill"></i>&nbsp;&nbsp;تعديل علي حاله الفاتوره </a>
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
					<!--/div-->

				

					
				</div>
				<!-- حذف الفاتورة -->
				<div class="modal fade" id="delete_invoice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">حذف الفاتورة</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <form action="{{route('invoicesgroup.destroy','test')}}" method="post">
                        {{ method_field('delete') }}
                        @csrf
                </div>
                <div class="modal-body">
                    هل انت متاكد من عملية الحذف ؟
                    <input type="hidden" name="invoice_id" id="invoice_id" value="">
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
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')

<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{ URL::asset('assets/js/table-data.js') }}"></script>
<!-- Internal Prism js-->
<script src="{{ URL::asset('assets/plugins/prism/prism.js') }}"></script>
<!--Internal  Datepicker js -->
<script src="{{ URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js') }}"></script>
<!-- Internal Select2 js-->
<script src="{{ URL::asset('assets/plugins/select2/js/select2.min.js') }}"></script>
<!-- Internal Modal js-->
<script src="{{ URL::asset('assets/js/modal.js') }}"></script>

<script src="{{URL::asset('assets/plugins/notify/js/notifIt.js')}}"></script>
<script src="{{URL::asset('assets/plugins/notify/js/notifit-custom.js')}}"></script>
<script>
	$(function(){
	$('.delete_invoice_and_retrivel').on('click', function(){
// console.log($(this));		
var invoices =this.getAttribute('data-invoice_id');
var d=document.querySelector('.modal-body #invoice_id');
d.value=invoices;

	})})
</script>
@endsection