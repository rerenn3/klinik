<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Product;

class AppServiceProvider extends ServiceProvider
{
    public function register() {}

    public function boot()
    {
        
        View::composer('*', function ($view) {
            $products = Product::with(['supplier', 'unit', 'category'])->get();

            $lowStockItems = collect();
            $outOfStockItems = collect();

            foreach ($products as $product) {
                // Ambil stock dari field 'quantity'
                $current_stock = $product->quantity;

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
