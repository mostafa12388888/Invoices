<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class inovice_attachment extends Model
{
    protected $fillable=[
        'file_name',
        'invoice_number',
        'created_by',
        'invoice_id',
    ];
    use HasFactory;
}
