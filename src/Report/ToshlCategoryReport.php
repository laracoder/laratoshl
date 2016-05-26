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
        return [
            'income' => $this->Toshl->getCategoriesIncomeSumsForCurrentMonth(), 
            'expense' => $this->Toshl->getCategoriesExpenseSumsForCurrentMonth()
        ];
    }

}