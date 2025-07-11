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

class ProductController extends Controller
{
    public function ProductAll()
    {
        $product = Product::latest()->get();
        return view('backend.product.product_all', compact('product'));
    } // End Method

    public function ProductAdd()
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        return view('backend.product.product_add', compact('supplier', 'category', 'unit'));
    } // End Method

    public function ProductStore(Request $request)
    {
        // Validasi input termasuk harga (boleh kosong)
        $request->validate([
            'name' => 'required',
            'supplier_id' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'harga' => 'nullable|regex:/^[0-9.]+$/'
        ]);

        // Bersihkan format harga (hapus titik)
        $harga = $request->harga ? str_replace('.', '', $request->harga) : null;

        Product::insert([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'quantity' => 0,
            'harga' => $harga, // simpan harga
            'created_by' => Auth::user()->id,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
    } // End Method

    public function ProductEdit($id)
    {
        $supplier = Supplier::all();
        $category = Category::all();
        $unit = Unit::all();
        $product = Product::findOrFail($id);
        return view('backend.product.product_edit', compact('product', 'supplier', 'category', 'unit'));
    } // End Method

    public function ProductUpdate(Request $request)
    {
        $product_id = $request->id;

        // Validasi input termasuk harga (boleh kosong)
        $request->validate([
            'name' => 'required',
            'supplier_id' => 'required',
            'unit_id' => 'required',
            'category_id' => 'required',
            'harga' => 'nullable|regex:/^[0-9.]+$/'
        ]);

        // Bersihkan format harga (hapus titik)
        $harga = $request->harga ? str_replace('.', '', $request->harga) : null;

        Product::findOrFail($product_id)->update([
            'name' => $request->name,
            'supplier_id' => $request->supplier_id,
            'unit_id' => $request->unit_id,
            'category_id' => $request->category_id,
            'harga' => $harga, // update harga
            'updated_by' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('product.all')->with($notification);
    } // End Method

    public function ProductDelete($id)
    {
        Product::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method
    public function getProductHarga(Request $request)
    {
        $product = \App\Models\Product::find($request->product_id);
        // Field di database: harga
        return response()->json($product ? $product->harga : 0);
    }


}
