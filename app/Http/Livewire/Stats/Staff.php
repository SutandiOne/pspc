<?php

namespace App\Http\Livewire\Stats;

use App\Models\Ppc;
use Livewire\Component;
use App\Models\Marketing;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class Staff extends Component
{
    public function render()
    {

        $marketing_l = Marketing::where('gender', 'L')->count();
        $marketing_p = Marketing::where('gender', 'P')->count();

        $ppc_l = Ppc::where('gender', 'L')->count();
        $ppc_p = Ppc::where('gender', 'P')->count();

        $gender_l = $marketing_l + $ppc_l;
        $gender_p = $marketing_p + $ppc_p;

        $marketing_count = $marketing_l + $marketing_p;
        $ppc_count = $ppc_l + $ppc_p;

        $chartGender = (new PieChartModel())
            ->setTitle('Staff Berdasarkan Gender')
            ->addSlice('Laki-laki', $gender_l , '#f19066')
            ->addSlice('Perempuan', $gender_p , '#f78fb3');

        $chartRole = (new PieChartModel())
        ->setTitle('Staff Berdasarkan Bagian')
        ->addSlice('Marketing', $marketing_count , '#0097e6')
        ->addSlice('PPC', $ppc_count , '#40739e');




        return view('livewire.stats.staff')->with([
            'chartGender' => $chartGender,
            'chartRole' => $chartRole
        ]);

    }
}
