<?php

namespace App\Orchid\Layouts\Chart;

use Orchid\Screen\Layouts\Chart;

class WaterChart extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Вода';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'bar';

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'water';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = false;

    protected $height = 300;

//    protected $lineOptions = [
//        'spline'     => 1,
//        'regionFill' => 1,
//        'hideDots'   => 0,
//        'hideLine'   => 0,
//        'heatline'   => 0,
//        'dotSize'    => 3,
//    ];
}
