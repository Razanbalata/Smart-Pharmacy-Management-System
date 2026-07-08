<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\PurchaseOrder;
use App\Models\Sale;
use App\Models\Supplier;
use App\Services\ReportService;
use Illuminate\Support\Carbon;

class ReportController extends Controller
{

    public function __construct(
        protected ReportService $reportService
    ) {}

    public function profits()
{
    return Sale::with('items.product')
        ->where('status', 'completed')
        ->where('pharmacy_id', auth()->user()->pharmacy_id)
        ->get();
}

    public function index()
    {
        // 1. حساب مبيعات الشهر الحالي (Sales)
        $monthlySales = Sale::query()
            ->whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->sum('total'); // افترضنا اسم الحقل total_amount

        // 2. عدد المشتريات المعلقة (Purchases)
        $pendingPurchasesCount = PurchaseOrder::query()
            ->where('status', 'pending')->count();

        // 3. تقييم المخزن المالي الإجمالي (Inventory Valuation)
        // بضرب الكمية بسعر التكلفة لكل منتج
        $stockValuation = Product::query()
            ->selectRaw('SUM(stock_quantity * purchase_price) as total')
            ->value('total') ?? 0;

        // 4. عدد المرضى/الزبائن النشطين (Customers)
        //$activeCustomers = Customer::where('status', 'active')->count() . ' Patients';

        // 5. عدد الشركات الموردة (Suppliers)
        $suppliersCount = Supplier::count();

        // يمكن حساب هامش الربح هنا أيضاً وتمريره (Profit Margin)
        $growthRate = 24.5; // كمثال ثابت أو معادلة حسابية بناءً على المبيعات والتكلفة

        // تمرير جميع المتغيرات إلى ملف الـ View الخاص بالتقارير
        return view('reports.index', compact(
            'monthlySales',
            'pendingPurchasesCount',
            'stockValuation',
            //'activeCustomers',
            'suppliersCount',
            'growthRate'
        ));
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
        return view('reports.profit', [
            'profits' => $this->profits(),
         'revenue' => $this->reportService->totalRevenue(),
            'cost' => $this->reportService->totalCost(),
            'profit' => $this->reportService->totalProfit(),
            'margin' => $this->reportService->profitMargin(),
        ]);
    }


    public function inventory()
    {
        return view('reports.inventory', [

            'productsCount' => Product::count(),


            'stockValue' => Product::query()
                ->selectRaw('SUM(stock_quantity * purchase_price) as total')->value('total') ?? 0,


            'lowStock' => Product::query()
                ->whereColumn(
                    'stock_quantity',
                    '<=',
                    'minimum_stock'
                )
                ->count(),


            'expired' => Product::query()
                ->whereDate(
                    'expiration_date',
                    '<',
                    today()
                )->count(),

        ]);
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
