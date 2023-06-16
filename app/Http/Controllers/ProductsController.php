<?php

namespace App\Http\Controllers;

use App\Models\products;
use Illuminate\Http\Request;
use App\Models\section;
class ProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['status']);
        $this->middleware('permission:المنتجات',['only'=>['index']]);
        $this->middleware('permission:تعديل منتج',['only'=>['update']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_product=products::all();
        $data_section=section::all();
        return view('sections.proudects',compact('data_section','data_product'));
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
        // return $request;

        $request->validate([
            'name_of_prodcts'=>'required',
            'descrption'=>'required',
            'section_name'=>'required',
        ],[
            'product_name.required'=>'انت لم تدخل اسم المنتج',
            'descrption.required'=>'انت لم تخل اي ملحوظه',
            'section_id.required'=>'انت لم تختار القم ',
        ]);
        
        products::create([
            'product_name'=>$request->name_of_prodcts,
    'section_id'=>$request->section_name,
    'descrption'=>$request->descrption,
    ]);
    return redirect('products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // return $request->pro_id;
        $request->validate([
            'Product_name'=>'required',
            
            'description'=>'required',
            'section_name'=>'required',
        ],[
            'Product_name.required'=>'انت لم تدخل اسم المنتج',
            'description.required'=>'انت لم تخل اي ملحوظه',
            'section_name.required'=>'انت لم تختار القم ',
            
        ]);
        // return $request->pro_id;
        $pr=products::find($request->pro_id);
        // return $pr;
$pr->update([
    'product_name'=>$request->Product_name,
    'section_id'=>$request->section_name,
    'descrption'=>$request->description,
]);
return redirect('products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        products::destroy($request->pro_id);
    //  products::find($request->pro_id)->delete();
     return redirect('products');
    }
}
