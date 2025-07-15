<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\Unit;
use Auth;
use Illuminate\Support\Carbon;

class StockController extends Controller
{
    public function StockReport(){
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('backend.stock.stock_report', compact('allData'));
    }

    public function StockReportPdf(){
        $allData = Product::orderBy('supplier_id','asc')->orderBy('category_id','asc')->get();
        return view('backend.pdf.stock_report_pdf', compact('allData'));
    }

    public function StockSupplierWise(){
        $supppliers = Supplier::all();
        $category = Category::all();
        return view('backend.stock.supplier_product_wise_report', compact('supppliers', 'category'));
    }

    public function SupplierWisePdf(Request $request){
        $allData = Product::orderBy('supplier_id','asc')
            ->orderBy('category_id','asc')
            ->where('supplier_id', $request->supplier_id)
            ->get();

        return view('backend.pdf.supplier_wise_report_pdf', compact('allData'));
    }

    public function ProductWisePdf(Request $request){
        $product = Product::where('category_id', $request->category_id)
            ->where('id', $request->product_id)
            ->first();

        return view('backend.pdf.product_wise_report_pdf', compact('product'));
    }

    public function ManageStock(){
        $allProducts = Product::orderBy('name')->get();
        return view('backend.stock.manage_stock', compact('allProducts'));
    }

    // Tambahan: Menampilkan Produk dengan Stok Kurang dari 5
    public function LowStockReport(){
        $lowStocks = Product::where('quantity', '<', 5)
            ->orderBy('quantity', 'asc')
            ->get();

        return view('backend.stock.low_stock_report', compact('lowStocks'));
    }
}
