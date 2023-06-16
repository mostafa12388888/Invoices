@extends('layouts.master')
@section('css')
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
            <h4 class="content-title mb-0 my-auto">المنتجات</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قصم المنتجات</span>
        </div>
    </div>

</div>
<!-- breadcrumb -->
@endsection
@section('content')

<!-- row -->
@if($errors->any())


<div class="alert alert-danger alert-dismissible  fade show" role="alert">
    <ul>
        @foreach($errors->all() as $er)
        <tr>
        <li>{{$er}}</li></tr>
        @endforeach
    </ul>
    <button class="close" data-dismiss="alert" aria-label="close"> <span aria-hidden="true">&times;</span></button>
</div>
@endif
<div class="row">
    <div class="col-sm-6 col-md-4 col-xl-3">
        <a class="modal-effect btn btn-outline-primary btn-block" data-effect="effect-scale" data-toggle="modal" href="#modaldemo8">اضافه قسم</a>
    </div>
    <div class="col-xl-12">
        <div class="card">

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table text-md-nowrap" id="example1">
                        <thead>
                            <tr>
                                <th class="wd-15p border-bottom-0">#</th>
                                <th class="wd-15p border-bottom-0">اسم المنتج</th>
                                <th class="wd-20p border-bottom-0">اسم القسم</th>
                                <th class="wd-15p border-bottom-0">ملاحظات</th>
                                <th class="wd-10p border-bottom-0">العمليات</th>


                            </tr>
                        </thead>
                        <tbody>
                            {{$counter=1}}
                            @foreach($data_product as $value)
                            <tr>
                                <td>{{$counter++}}</td>
                                <td>{{$value->product_name}}</td>
                                <td>{{$value->sections->section_name}}</td>
                                <td>{{$value->descrption}}</td>

                                <td>
                                    @can('تعديل منتج')
                                    <button class="btn btn-outline-success btn-sm" data-name="{{$value->product_name}}" data-id="{{$value->id}}" data-section_name="{{$value->sections->section_name}}" data-description="{{$value->descrption}}" data-toggle="modal" data-target="#edit_Product">تعديل</button>
@endcan
@can('حذف منتج')
                                    <button class="btn btn-outline-danger btn-sm " data-toggle="modal" data-target="#modaldemo9{{$value->id}}">حذف</button>
                                    <div class="modal fade" id="modaldemo9{{$value->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">حذف المنتج</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <form action="products/destroy" method="post">
                                                    {{ method_field('delete') }}
                                                    @csrf
                                                    <div class="modal-body">
                                                        <p>هل انت متاكد من عملية الحذف ؟</p><br>
                                                        <input type="hidden" name="pro_id" id="pro_id" value="{{$value->id}}">
                                                        <input class="form-control" name="product_name" id="product_name" type="text" value="{{$value->product_name}}" readonly>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                                        <button type="submit" class="btn btn-danger">تاكيد</button>
                                                    </div>
                                                </form>
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
    <!--/div-->






</div>
</div>
<div class="modal" id="modaldemo8">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-content-demo">
            <div class="modal-header">
                <h6 class="modal-title">>اضافه قسم</h6><button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('products.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="name_of_prodcts">اضافه منتج</label>
                        <input type="text" id="name_of_prodcts" class="form-control" name='name_of_prodcts'>
                    </div>
                    <div class="form-group">
                        <label for="section_name"> اسم القسم</label></br>
                        <select name="section_name" id="section_name">

                            @foreach($data_section as $value1)

                            <option value="{{$value1->id}}">{{$value1->section_name}}</option>
                            @endforeach
                        </select>
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
<div class="modal fade" id="edit_Product" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تعديل منتج</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action='products/update' method="post">
                {{ method_field('patch') }}
                {{ csrf_field() }}
                <div class="modal-body">

                    <div class="form-group">
                        <label for="title">اسم المنتج :</label>

                        <input type="hidden" class="form-control" name="pro_id" id="product_of_id" value="">

                        <input type="text" class="form-control" name="Product_name" id="Product_name">
                    </div>

                    <label class="my-1 mr-2" for="inlineFormCustomSelectPref">القسم</label>
                    <select name="section_name" id="section_of_product_name22" class="custom-select my-1 mr-sm-2" required>
                        @foreach ($data_section as $section)
                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                        @endforeach
                    </select>

                    <div class="form-group">
                        <label for="des">ملاحظات :</label>
                        <textarea name="description" cols="20" rows="5" id='description' class="form-control"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">تعديل البيانات</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
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
<script>
    var id = document.querySelector('#product_of_id');
    $(function() {
        var name = document.querySelector('#Product_name');
        console.log(name);
        var description = document.querySelector('#description');
        var select = document.querySelector('#section_of_product_name22');


        $('.btn.btn-outline-success.btn-sm').on('click', function() {
            name.value = this.getAttribute('data-name');
            description.value = this.getAttribute('data-description');
            id.value = this.getAttribute('data-id');
            
            
             
            console.log(s);
            console.log(this.getAttribute('data-section_name'));
        })
    })
</script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jquery.dataTables.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/jszip.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js') }}"></script>
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
@endsection