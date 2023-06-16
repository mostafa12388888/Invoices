<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class invoices extends Model
{
    use SoftDeletes;
    protected $fillable=[
 'invoice_number','invoices_date','due_date','proudect','section_id','amount_collection',
 'amount_comission',
 'discount','value_vate','rate_vat','total','statues',
 'user','value_status','note','payment_date',
];
protected $date=['deleted_at'];
public function section_name(){
    return $this->BelongsTo(section::class,'section_id','id');
}
    use HasFactory;
}
