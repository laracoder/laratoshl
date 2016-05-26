<?php

namespace Elcheffe\Laratoshl\Report;
use Carbon\Carbon;

/**
 * Class ToshlCategoryReport
 * @package Laratoshl
 */
class ToshlCategoryReport extends ToshlReport
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getData(Carbon $date)
    {
        return [
            'income' => $this->Toshl->getCategoriesIncomeSumsForMonth($date),
            'expense' => $this->Toshl->getCategoriesExpenseSumsForMonth($date)
        ];
    }

}