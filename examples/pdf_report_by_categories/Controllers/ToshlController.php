<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Elcheffe\Laratoshl\Report\ToshlCategoryReport;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

/**
 * Class ToshlController
 * @package App\Http\Controllers
 */
class ToshlController extends Controller
{
    /**
     * Category Listing Test
     * @param ToshlCategoryReport $Report
     */
    public function test(ToshlCategoryReport $Report)
    {
        setlocale(LC_TIME, 'German');

        $year = Carbon::now()->formatLocalized('%Y');
        $month = Carbon::now()->formatLocalized('%B');

        $data = [
            'content' => $Report->getData(),
            'month' => $month,
            'year' => $year
        ];

       $pdf = Pdf::loadView('report_categories', $data);

       return $pdf->stream('report_'.strtolower($month).'_'.$year.'.pdf');
    }
}
