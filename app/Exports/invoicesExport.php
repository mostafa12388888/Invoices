<?php

namespace App\Exports;

use App\Models\invoices;
use Maatwebsite\Excel\Concerns\FromCollection;

class invoicesExport implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return invoices::select('invoice_number','invoices_date','proudect','amount_collection','discount','total','statues','note')->get();
    }
}
