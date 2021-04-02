<?php

namespace App\Http\Livewire\Stats;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\Customer as Customers;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Customer extends Component
{
    public function render()
    {
        // $year = 2019; //Carbon::now()->year;

        $customer = Customers::with('sparepart')->get();
        
        $chartCustomer = $customer->groupBy('nama')
            ->reduce(function ($chartCustomer, $data) {
                $nama = $data->first()->nama;
                $value = $data->first()->sparepart_count;

                return $chartCustomer->addColumn($nama, $value, sprintf('#%06X', mt_rand(0, 0xFFFFFF)));
            }, LivewireCharts::columnChartModel()
                ->setTitle('Jumlah Request Customer')
                ->stacked()
                ->withGrid()
                ->withoutLegend()
                ->setAnimated(true)
            );
            
        // dd($customer);

        return view('livewire.stats.customer')->with([
            'chartCustomer' => $chartCustomer
        ]);
    }
}
