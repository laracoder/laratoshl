<?php

namespace Elcheffe\Laratoshl\Report;

/**
 * Class ToshlCategoryReport
 * @package Laratoshl
 */
class ToshlCategoryReport extends ToshlReport
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getData()
    {
        // get Entries
        $categorySumsForCurrentMonth = $this->Toshl->getCategoriesSumsForCurrentMonth('EUR');

        return $categorySumsForCurrentMonth;
    }

}