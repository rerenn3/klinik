<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\Product;
use App\Models\Unit;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;

class DefaultController extends Controller
{
    public function GetCategory(Request $request){

        $supplier_id = $request->supplier_id;
        // dd($supplier_id);
        $allCategory = Product::with(['category'])->select('category_id')->where('supplier_id',$supplier_id)->groupBy('category_id')->get();
        return response()->json($allCategory);
    } // End Mehtod 

     public function GetProduct(Request $request){

        $category_id = $request->category_id; 
        $allProduct = Product::where('category_id',$category_id)->get();
        return response()->json($allProduct);
    } // End Mehtod 


    public function GetStock(Request $request){
        $product_id = $request->product_id;
        $stock = Product::where('id',$product_id)->first()->quantity;
        return response()->json($stock);

    } // End Mehtod 

    public function GetProductHarga(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        return response()->json([
            'harga' => $product->harga,        // atau 'unit_price' sesuai nama field harga di tabel kamu
            'stock' => $product->quantity,     // field stok di table products
        ]);
    }


        // app/Http/Controllers/Pos/DefaultController.php
    public function GetProductInfo($id){
        $product = Product::with(['category', 'supplier'])->findOrFail($id);
        return response()->json([
            'category_id' => $product->category_id,
            'category_name' => $product->category->name,
            'supplier_id' => $product->supplier_id,
            'supplier_name' => $product->supplier->name,
            'harga' => $product->harga,
        ]);
}


    
    






}
 