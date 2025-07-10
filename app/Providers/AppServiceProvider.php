<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\InvoiceDetail;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Komposisi data stok dari transaksi pembelian & penjualan
        View::composer('*', function ($view) {
            $products = Product::with(['supplier', 'unit', 'category'])->get();

            $lowStockItems = collect();
            $outOfStockItems = collect();

            foreach ($products as $product) {
                $buying_total = Purchase::where('category_id', $product->category_id)
                    ->where('product_id', $product->id)
                    ->where('status', '1')
                    ->sum('buying_qty');

                $selling_total = InvoiceDetail::where('category_id', $product->category_id)
                    ->where('product_id', $product->id)
                    ->where('status', '1')
                    ->sum('selling_qty');

                $current_stock = $buying_total - $selling_total;

                if ($current_stock <= 5 && $current_stock > 0) {
                    $product->current_stock = $current_stock;
                    $lowStockItems->push($product);
                }

                if ($current_stock <= 0) {
                    $product->current_stock = 0;
                    $outOfStockItems->push($product);
                }
            }

            $totalAlerts = $lowStockItems->count() + $outOfStockItems->count();

            $view->with('lowStockItems', $lowStockItems);
            $view->with('outOfStockItems', $outOfStockItems);
            $view->with('totalStockAlerts', $totalAlerts);
        });
    }
}
