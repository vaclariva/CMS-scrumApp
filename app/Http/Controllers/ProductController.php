<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $products = Product::latest()->get();
        info($products);
        return view('pages.add-product', compact('users', 'products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'icon' => 'required|string',
            'name' => 'required|string',
            'label' => 'required|string',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            DB::beginTransaction();

            Product::create([
                'icon' => $request->icon,
                'name' => $request->name,
                'label' => $request->label,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'user_id' => $request->user_id,
            ]);

            DB::commit();
            return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('product')->with('error', 'Gagal menambahkan data. Silakan coba lagi.');
        }
    }


    /**
     * Display the specified resource.
     */

    public function show($productId)
    {
        $product = Product::findOrFail($productId);
        $productOwner = $product->user()->first();
        $vision_boards = $product->vision_board;

        return view('pages.detail-product', compact('productOwner', 'vision_boards', 'product'));
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('components.modal-edit-product', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'icon' => 'required|string',
            'name' => 'required|string',
            'label' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);

            $product->update([
                'icon' => $request->icon,
                'name' => $request->name,
                'label' => $request->label,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'user_id' => $request->user_id,
            ]);

            DB::commit();
            return redirect()->route('product')->with('success', 'Produk berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->route('product')->with('error', 'Gagal memperbarui data. Silakan coba lagi.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            $deletedProductId = $product->id;

            $product->delete();

            $products = Product::orderBy('id')->get();

            return redirect()->route('product')->with('success', 'Produk berhasil dihapus');
        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            return Redirect::to(route('product'))->with('error', 'Gagal menghapus produk.');
        }
    }

    public function duplicate(Product $product)
    {
        try {
            info($product);
            $newProduct = Product::create([
                'name' => $product->name . "-copy",
                'icon' => $product->icon,
                'label' => $product->label,
                'start_date' => $product->start_date,
                'end_date' => $product->end_date,
                'user_id' => $product->user_id,
            ]);


            Log::info('New product created:', $newProduct->toArray());

            return redirect()->route('product')->with('success', 'Berhasil duplikasi.');
        } catch (\Exception $e) {
            Log::error('Error duplicate product: ' . $e->getMessage());
            return Redirect::to(route('product'))->with('error', 'Gagal duplikasi.');
        }
    }
}
