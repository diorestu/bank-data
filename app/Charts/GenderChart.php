<?php

namespace App\Charts;

use App\Models\Lead;
use Illuminate\Support\Facades\DB;
use ArielMejiaDev\LarapexCharts\LarapexChart;

class GenderChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }

    public function build(): \ArielMejiaDev\LarapexCharts\PieChart
    {
        $kawin = Lead::select('kawin', DB::raw("COUNT(*) as count"))->groupBy('kawin')->pluck('count', 'kawin')->toArray();
        return $this->chart->pieChart()
            ->setTitle('Klasifikasi Status Kawin')
            ->setColors(['#5e548e', '#9f86c0'])
            ->setLabels(array_keys($kawin))
            ->addData(array_values($kawin));
    }
}
