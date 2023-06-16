<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class details_Invoices extends Model
{
    protected $fillable=[
        'id_Invoice',
        'invoice_number',
        'product',
        'section',
        'status',
        'value_status',
        'note',
        'user',
        'payment_date'
    ];
    use HasFactory;
}
