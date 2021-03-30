<?php

namespace App\Http\Livewire\Grafik;

use Livewire\Component;
use App\Models\SparePart;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;
use Asantibanez\LivewireCharts\Models\ColumnChartModel;

class Ppc extends Component
{

    public function render()
    {
        $year = Carbon::now()->year;

        $spareparts = SparePart::where('ppc_id', Auth::user()->ppc->id)->whereYear('date_finish', $year)->get();

        $sparepart = $spareparts->countBy(function($d) {
            return Carbon::parse($d->date_finish)->format('m');
        });
        
        $columnChartModel = (new ColumnChartModel())
            ->setTitle('Jumlah')
            ->addColumn('Jan', $sparepart['01'] ?? 0, '#f6ad55')
            ->addColumn('Feb', $sparepart['02'] ?? 0, '#fc8181')
            ->addColumn('Mar', $sparepart['03'] ?? 0, '#90cdf4')
            ->addColumn('Apr', $sparepart['04'] ?? 0, '#f6ad55')
            ->addColumn('Mei', $sparepart['05'] ?? 0, '#fc8181')
            ->addColumn('Jun', $sparepart['06'] ?? 0, '#90cdf4')
            ->addColumn('Jul', $sparepart['07'] ?? 0, '#f6ad55')
            ->addColumn('Aug', $sparepart['08'] ?? 0, '#fc8181')
            ->addColumn('Sep', $sparepart['09'] ?? 0, '#90cdf4')
            ->addColumn('Okt', $sparepart['10'] ?? 0, '#f6ad55')
            ->addColumn('Nov', $sparepart['11'] ?? 0, '#fc8181')
            ->addColumn('Des', $sparepart['12'] ?? 0, '#90cdf4')->withoutLegend()->setAnimated(true);

        return view('livewire.grafik.ppc')->with([
            'columnChartModel' => $columnChartModel
        ]);
    }
}
