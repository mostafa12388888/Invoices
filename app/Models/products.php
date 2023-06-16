<?php

namespace App\Models;
use App\Models\section;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable =[
        'product_name','section_id','descrption',
    ];
    public function sections(){
        return $this->belongsTo(section::class,'section_id','id');
    }
    // public function sections(){
    //     return $this->belongsTo('App\Models\section','sections.id');
    // }
    use HasFactory;
}
