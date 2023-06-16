<?php

namespace App\Http\Controllers;
use App\Models\invoices;
use Illuminate\Http\Request;

class Home_page extends Controller
{
    public function __construct()
    {
        $this->middleware(['status']);
    }
    public function index(){
$counter_total=invoices::count();
$counter11=invoices::where('value_status',1)->count();
$counter22=invoices::where('value_status',2)->count();
$counter33=invoices::where('value_status',3)->count();
$counter1=($counter11/($counter_total+1))*100;
$counter2=($counter22/($counter_total+1))*100;
$counter3=($counter33/($counter_total+1))*100;

        $chartjs = app()->chartjs
         ->name('barChartTest')
         ->type('bar')
         ->size(['width' => 400, 'height' => 200])
         ->labels(['الفواتير المدفوعه', ' الفوتير الغير مدفوعه','الفواتير المدفوعه جذئيه'])
         ->datasets([
             [
                 "label" => "الفواتير ",
                 'backgroundColor' => ['#1e81b0', '#80391e','#80391e'],
                 'data' => [$counter1, $counter2,$counter3]
             ],
            
             
         ])
         ->options([]);
         //uu
         $chartjs2 = app()->chartjs
        ->name('pieChartTest')
        ->type('pie')
        ->size(['width' => 400, 'height' => 200])
        ->labels(['الفواتير المدفوعه', ' الفوتير الغير مدفوعه','الفواتير المدفوعه جذئيه'])
        ->datasets([
            [
                'backgroundColor' => ['#FF6384', '#36A2EB'],
                'hoverBackgroundColor' => ['#FF6384', '#36A2EB'],
                'data' => [$counter1, $counter2,$counter3]
            ]
        ])
        ->options([]);

return view('index', compact('chartjs','chartjs2'));



    }
}
