<?php

namespace App\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\InventoryReportService;
use Illuminate\Support\Carbon;

class InventoryController extends Controller
{

    public function __construct(
        protected InventoryReportService $inventoryService
    ) {}


    public function index()
    {
        // --- 1. كارد إجمالي المنتجات ونسبة النمو ---
        $totalItems = Product::count();

        $thisMonthCount = Product::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)->count();
        $lastMonthCount = Product::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)->count();

        $growthRate = $lastMonthCount > 0
            ? (($thisMonthCount - $lastMonthCount) / $lastMonthCount) * 100
            : 0;

        // --- 2. كارد المنتجات القريبة من النفاد وقائمتها السفلية ---
        // نفترض أن حد الأمان (Low Stock) هو 10 قطع أو أقل
        $lowStockThreshold = 10;
        $lowStockCount = Product::query()
            ->where('stock_quantity', '>', 0)
            ->where('stock_quantity', '<=', $lowStockThreshold)
            ->count();

        // جلب أول 5 منتجات فقط للعرض في القائمة السفلية السريعة
        $lowStockProducts = Product::query()
            ->where('stock_quantity', '>', 0)
            ->where('stock_quantity', '<=', $lowStockThreshold)
            ->take(5)
            ->get();

        // --- 3. كارد المنتجات النافدة تماماً ---
        $outOfStockCount = Product::query()->where('stock_quantity', 0)->count();

        // --- 4. كارد المنتجات القريبة من الانتهاء وقائمتها السفلية ---
        // المنتجات التي ستنتهي خلال الـ 60 يوم القادمة ولم تنتهِ بعد
        $expiringCount = Product::query()->where('expiration_date', '>=', Carbon::now())
            ->where('expiration_date', '<=', Carbon::now()->addDays(60))
            ->count();

        // جلب أول 5 منتجات قريبة من الانتهاء للقائمة السفلية
        $expiringProducts = Product::query()->where('expiration_date', '>=', Carbon::now())
            ->where('expiration_date', '<=', Carbon::now()->addDays(60))
            ->take(5)
            ->get();

        // --- 5. كارد المنتجات المنتهية الصلاحية فعلياً ---
        $expiredCount = Product::query()->where('expiration_date', '<', Carbon::now())->count();

        // --- 6. كارد حركات المخزن الأخيرة ---
        // إذا كان عندك جدول للحركات (StockMovements)، يمكنك عده هكذا، أو عد التحديثات اليومية في جدول المنتجات
        // هنا سنحسب المنتجات التي تم تحديث كمياتها اليوم كمثال:
        $movementCount = Product::query()
        ->whereDate('updated_at', Carbon::today())->count();


        // تمرير كل البيانات المجهزة إلى صفحة الـ Blade
        return view('inventory.index', compact(
            'totalItems',
            'growthRate',
            'lowStockCount',
            'lowStockProducts',
            'outOfStockCount',
            'expiringCount',
            'expiringProducts',
            'expiredCount',
            'movementCount'
        ));
    }


    public function stock()
    {
        return view('inventory.stock');
    }


    public function lowStock()
    {
        return view('inventory.low-stock');
    }


    public function outOfStock()
    {
        return view('inventory.out-stock');
    }


    public function expiring()
    {
        return view('inventory.expiring');
    }


    public function expired()
    {
        return view('inventory.expired');
    }


    public function movements()
    {
        return view('inventory.movements');
    }
}
