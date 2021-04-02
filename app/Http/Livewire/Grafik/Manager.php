<?php

namespace App\Http\Livewire\Grafik;

use App\Models\Ccr;
use App\Models\Rjo;
use Livewire\Component;
use App\Models\SparePart;
use Illuminate\Support\Carbon;
use App\Models\PekerjaanSelesai;
use Asantibanez\LivewireCharts\Models\PieChartModel;
use Asantibanez\LivewireCharts\Facades\LivewireCharts;

class Manager extends Component
{
    public function render()
    {
        $month = Carbon::now()->month;

        $total_rjo = Rjo::doesntHave('ccr')->whereMonth('date_received', $month)->count();
        $total_ccr = Ccr::doesntHave('pekerjaan_selesai')->whereMonth('updated_at', $month)->count();
        $total_selesai = PekerjaanSelesai::whereMonth('date_finish', $month)->count();
        $total_kirim = SparePart::whereMonth('created_at', $month)->count();

        $chartStatus = (new PieChartModel())
            ->setTitle('STATUS PEKERJAAN BULAN INI')
            ->addSlice('Repair Job Order', $total_rjo , '#fc8181')
            ->addSlice('Component Condition Report', $total_ccr , '#f6ad55')
            ->addSlice('Pekerjaan Selesai', $total_selesai , '#90cdf4')
            ->addSlice('Telah Dikirim', $total_kirim , '#55efc4')->setAnimated(true);

        return view('livewire.grafik.manager')->with([
            'chartStatus' => $chartStatus
        ]);
    }
}
