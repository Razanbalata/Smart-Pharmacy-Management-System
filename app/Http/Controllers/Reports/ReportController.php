<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;


class ReportController extends Controller
{

    public function index()
    {
        return view('reports.index');
    }


    public function sales()
    {
        return redirect()->route('sales.index');
    }


    public function purchases()
    {
        return redirect()->route('purchase.index');
    }


    public function profit()
    {
        return view('reports.profit');
    }


    public function inventory()
    {
        return view('reports.inventory');
    }


    public function customers()
    {
        return view('reports.customers');
    }


    public function suppliers()
    {
        return view('suppliers.index');
    }

}