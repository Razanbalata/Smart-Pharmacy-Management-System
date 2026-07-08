<?php

namespace App\Services;


use App\Models\Sale;


class ReportService
{


    public function totalRevenue()
    {
        return Sale::where('status', 'completed')
            ->sum('total');
    }



    public function totalCost()
    {

        return Sale::where('status', 'completed')
            ->with('items.product')
            ->get()
            ->sum(function ($sale) {


                return $sale->items->sum(function ($item) {


                    return $item->quantity *
                        $item->product->purchase_price;
                });
            });
    }



    public function totalProfit()
    {

        return $this->totalRevenue()
            -
            $this->totalCost();
    }



    public function profitMargin()
    {

        $revenue = $this->totalRevenue();


        if ($revenue == 0) {
            return 0;
        }


        return round(
            ($this->totalProfit() / $revenue) * 100,
            2
        );
    }
}
