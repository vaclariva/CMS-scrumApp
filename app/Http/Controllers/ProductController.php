<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Product;
use App\Models\User;
use App\Models\VisionBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $products = Product::latest()->get();
        $count = $products->count();
        $user = auth()->user();

        if ($user->role_id == 2) { 
            if ($count == 0) {
                return view('pages.add-products.add-product', compact('users', 'products'));
            }
            // Ambil produk terakhir dari $products
            $lastProduct = $products->first(); // Ambil produk terbaru
            return redirect()->route('products.show', $lastProduct->id);
        }

        $userProduct = $user->products()->latest()->first(); // Ambil produk terbaru pengguna

        if ($userProduct) {
            return redirect()->route('products.show', $userProduct->id);
        }

        return redirect()->route('dashboard');
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

            $product = Product::create([
                'icon' => $request->icon,
                'name' => $request->name,
                'label' => $request->label,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'user_id' => $request->user_id,
            ]);

            DB::commit();
            info('Produk berhasil ditambahkan');

            return redirect()->route('products.show', $product->id)
                            ->with('success', 'Produk berhasil ditambahkan');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan. Produk gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */

     public function show($productId)
    {
        $product = Product::findOrFail($productId);

        if (auth()->user()->role->name !== 'Super Admin') {
            if ($product->user_id !== auth()->user()->id) {
                abort(403);
            }
        }

        $productOwner = $product->user()->first();
        $visionBoards = VisionBoard::with('product')->where('product_id', $productId)->latest()->get();
        
        $backlogs = Backlog::with('product')->where('product_id', $productId)->latest()->get();

        $groupedBacklogs = Backlog::with('product')
            ->where('product_id', $productId)
            ->latest()
            ->get()
            ->groupBy('sprint_id');

        $groupedBacklogs = $groupedBacklogs->sortKeysDesc();

        return view('pages.vision-boards.detail-product', compact('productOwner', 'visionBoards', 'product', 'backlogs', 'groupedBacklogs'));
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
        //dd($request->all());
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

            $startDate = $request->start_date ?? $product->start_date;
            $endDate = $request->end_date ?? $product->end_date;

            $product->update([
                'icon' => $request->icon,
                'name' => $request->name,
                'label' => $request->label,
                'start_date' => $startDate,
                'end_date' => $endDate,
                'user_id' => $request->user_id,
            ]);

            DB::commit();
            return redirect()->back()->with('success', 'Product berhasil diperbarui');
        } catch (\Exception $e) {
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
            $count = $products->count();
            if ($count == 0) {
                return redirect()->route('product')->with('success', 'Produk berhasil dihapus');
            } else {
                $lastProducts = $products->last();
                return redirect()->route('products.show', $lastProducts->id)->with('success', 'Produk berhasil dihapus');
            }
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
