<?php

namespace App\Http\Controllers;

use App\Models\section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionController extends Controller
{
    public function __construct()
    {
        $this->middleware(['status']);
        $this->middleware('permission:الاقسام',['only'=>['index']]);
        $this->middleware('permission:تعديل قسم',['only'=>['update']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data=section::all();
        $counter=0;
        return view('sections.sections',compact('data','counter'));
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
        // $d=section::where('section_name','=',$request->section_name)->exists();
        //  if($d || isset($request) ){ 
        //     session()->flash('Error','هذا القسم موجودبالفعل');
        //     return redirect('sections');
        //     }
        $request->validate(['section_name'=> ['required',' unique:sections'],
        'descrption'=>'required'],
        ['section_name.required'=>'ادخل اسم القصم من فضلك',
        'section_name.unique'=>'هذا القصم موجود بالفعل ',
        'descrption.required'=>'انت لم تخل اي وصف لي القصم '
        
        ]);
            
                section::create([
                    'section_name'=>$request->section_name,
                    'descrption'=> $request->descrption,
                    'createby'=>auth::user()->name,
                ]);
            //    session()->flash('add','تم اضافه القصم بنجاح');
                return redirect('sections');

            
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function show(section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function edit(section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate(['section_name'=> 'required|unique:sections,section_name,'.$request->id,
        'description'=>'required'],
        ['section_name.required'=>'ادخل اسم القصم من فضلك',
        'section_name.unique'=>'القصم لم يتم تغييره ',
        'description.required'=>'لم تضع ملحوظه للقصم او ربما تحتفظ بالملحوظه القديمه'
        
        ]);
$section=section::find($request->id);
$section->update([
    'section_name'=>$request->section_name,
                    'descrption'=> $request->description,
                    
]);
return redirect('sections');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\section  $section
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return "ergt";
        section::destroy($id);
        // section::find($section)->delete();
       return redirect('sections');
    }
}
