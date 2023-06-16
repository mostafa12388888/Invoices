@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
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
			<h4 class="content-title mb-0 my-auto">الاعدادات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ الاقسام</span>
		</div>
	</div>
	<div class="d-flex my-xl-auto right-content">


	</div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<!-- @if(Session()->has('Error'))
				<div class='alert alert-danger alert-dismissible fade show' role='alert'>
					<strong> &nbsp;&nbsp;&nbsp;&nbsp; {{session()->get('Error')}}</strong>
					<button type="button" class='close' data-dismiss="alert" data-lable='close'>X</button>
					<span aria-hidden="true"> &times; </span>
				</div>
				@endif
				@if(session()->has('add'))
				<div class='alert alert-danger alert-dismissible fade show' role='alert'>
					<strong>&nbsp;&nbsp;&nbsp;&nbsp;{{session()->get('add')}}</strong>
					<button type="button" class='close' data-dismiss="alert" data-lable='close'>X</button>
					<span aria-hidden="true"> &times; </span>
				</div>
				@endif -->
@if($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<ul>
		@foreach ($errors->all() as $error)

		<tr>
			<li>{{$error}}</li>
		</tr>


		@endforeach
	</ul>
	<button class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span></button>
</div>
@endif
<div class="row">

	<div class="col-xl-12">
		<div class="col-sm-6 col-md-4 col-xl-3">
			<a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافه قسم</a>
		</div>
		<div class="card">

			<div class="card-body">

				<div class="table-responsive">
					<table class="table text-md-nowrap" id="example1">
						<thead>
							<tr>
								<th class="wd-15p border-bottom-0">#</th>
								<th class="wd-15p border-bottom-0">اسم القسم </th>


								<th class="wd-25p border-bottom-0">الوصف</th>
								<th class="wd-25p border-bottom-0">العمليات</th>
							</tr>
						</thead>
						<tbody>
							@foreach($data as $value)

							<tr>
								<td>{{++$counter}}</td>
								<td>{{$value->section_name}}</td>
								<td>{{$value->descrption}}</td>
								<td>
@can('تعديل قسم')
									<a class="modal-effect btn btn-sm btn-info" data-effect="effect-scale" data-id="{{ $value->id }}" data-section_name="{{ $value->section_name }}" data-description="{{$value->descrption}}" data-toggle="modal" href="#exampleModal2" title="تعديل"><i class="las la-pen"></i></a>
									<!-- Button trigger modal -->
@endcan
									<!-- Button trigger modal -->
									@can('حذف قسم')
									<a class="modal-effect btn btn-sm btn-danger" data-bs-target="#exampleModal" data-effect="effect-scale" data-toggle="modal" href="#exampleModalk{{$value->id}}" title="حذف"><i class="las la-trash"></i></a>


									<!-- Modal -->
									<div class="modal fade" id="exampleModalk{{$value->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModal">تاكيد الحذف</h5>
													<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
												</div>
												<div class="modal-body">
													هل تريد هحذف قصم :{{$value->section_name}}
												</div>
												<div class="modal-footer">
													<button class="btn btn-secondary" data-dismiss="modal" type="button">غلق</button>
													<form action="{{route('sections.destroy',$value->id)}}" method="post">

														@csrf
														@method('DELETE')

														<input class="btn btn-danger" type="submit" value="تاكيد الحذف">
													</form>
												</div>
											</div>
										</div>
									</div>
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
	<div class="modal" id="modaldemo8">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content modal-content-demo">
				<div class="modal-header">
					<h6 class="modal-title">>اضافه قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
				</div>
				<div class="modal-body">
					<form action="{{route('sections.store')}}" method="post">
						@csrf
						<div class="form-group">
							<label for="name_of_section">اسم القسم </label>
							<input type="text" id="name_of_section" class="form-control" name='section_name'>
						</div>
						<div class="form-group">
							<label for="notes_for_sction">الملاحظات</label>
							<textarea name="descrption" class="form-control" id="notes_for_section" rows="3"></textarea>
						</div>
						<div class="modal-footer">
							<button class="btn btn-success" type="submit">اضافه قسم </button>
							<button class="btn btn-secondary" data-dismiss="modal" type="button">غلاق</button>
						</div>
					</form>
				</div>


			</div>

		</div>


		<!-- row closed -->
	</div>
	<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">تعديل القسم</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

					<form action="sections/update" method="post" autocomplete="off">
						@csrf
						{{ method_field('patch') }}

						<div class="form-group">
							<input type="hidden" name="id" id="id" value="">
							<label for="recipient-name" class="col-form-label">اسم القسم:</label>
							<input class="form-control recipient-name" name="section_name" id="recipient-name" type="text">
						</div>
						<div class="form-group">
							<label for="message-text" class="col-form-label">ملاحظات:</label>
							<textarea class="form-control" id="message-text" name="description"></textarea>
						</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary">تاكيد</button>
					<button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
				</div>
				</form>
			</div>
		</div>
	</div>

</div>

<!-- Container closed -->
</div>

<!-- main-content closed -->
@endsection
@section('js')
<script>
	var description = document.querySelector('#message-text');
	var idd = document.querySelector('#id');

	$(function() {
		$('.modal-effect.btn.btn-sm.btn-info').on('click', function(event) {
			var name = document.querySelector('#recipient-name');

			description.value = this.getAttribute('data-description');
			idd.value = this.getAttribute('data-id');
			name.value = this.getAttribute('data-section_name');
		})

	})
</script>
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
<script src="{{URL::asset('assets/js/modal.js')}}"></script>
<!--Internal  Datatable js -->
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection