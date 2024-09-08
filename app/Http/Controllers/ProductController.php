<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $products = Product::all();
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
            'name'=> 'required',
            'label'=> 'required',
            'start_date'=> 'required|date',
            'end_date'=> 'required|date|after_or_equal:start_date',
            'user_id'=> 'required|exists:users,id',
        ]);

        try{
            DB::beginTransaction();
            Product::create($request->all());

            DB::commit();
            return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan');
        }catch(\Exception $e) {
            info($e);
            DB::rollBack();
            return redirect()->route('product')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    
     public function show($id)
    {
        session()->put('last_page', url()->current());

        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
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
    //public function update(Request $request, string $id)
    //{
        //
    //}

    public function update(Request $request, $id)
    {

        $request->validate([
            'icon' => 'required',
            'name' => 'required',
            'label' => 'required',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'user_id' => 'required|exists:users,id',
        ]);

        try {
            DB::beginTransaction();

            $product = Product::findOrFail($id);

            Log::info('Product found for update: ', $product->toArray());

            $product->update($request->only(['name', 'label', 'start_date', 'end_date', 'user_id', 'icon']));

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
                'name' => $product->name, 
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
