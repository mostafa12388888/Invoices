<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class section extends Model
{
    protected $fillable = [
        'section_name',
        'descrption',
        'createby',
    ];
    use HasFactory;
}
