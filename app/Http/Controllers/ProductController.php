<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Backlog;
use App\Models\Product;
use App\Models\VisionBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\ValidationException;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
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
        } catch (\Throwable $th) {
            info($th);
            abort(500);
        }

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
        
        try {            
            $request->validate([
                'icon' => 'required|string',
                'name' => 'required|string',
                'label' => 'required|string',
                'start_date' => 'required',
                'end_date' => 'required|after_or_equal:start_date',
                'user_id' => 'required|exists:users,id',
            ]);
    
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

            return redirect()->route('products.show', $product->id)
                            ->with('success', 'Produk berhasil ditambahkan');
        } catch (ValidationException $ve) {
            info($ve);
            $allErrors = array_values($ve->errors());
            return redirect()->back()->withInput()->with('error', $allErrors[0][0]);
        } catch (\Exception $e) {
            DB::rollBack();
            info($e);
            return redirect()->back()->withInput()->with('error', 'Terjadi kesalahan. Produk gagal ditambahkan');
        }
    }

    /**
     * Display the specified resource.
     */

    public function show(Product $product)
    {

        if (auth()->user()->role->name !== 'Super Admin') {
            if ($product->user_id !== auth()->user()->id) {
                abort(403);
            }
        }

        try {

            $productOwner = $product->user()->first();
            $visionBoards = $product->visionBoards()->with('product')->latest()->get();

            $backlogs = $product->backlogs()->with('product')
            ->withCount([
                'checklists as jumlahChecklistSelesai' => function ($query) {
                    $query->where('status', '1'); // Menghitung hanya checklist yang selesai
                },
                'checklists as jumlahChecklistTotal' // Menghitung total checklist tanpa syarat
            ])
            ->latest()
            ->get();

            $groupedBacklogs = $product->backlogs()->with('product')
                ->latest()
                ->get()
                ->groupBy('sprint_id');

            $groupedBacklogs = $groupedBacklogs->sortKeysDesc();

            return view('pages.vision-boards.detail-product', compact('productOwner', 'visionBoards', 'product', 'backlogs', 'groupedBacklogs'));

        } catch (\Throwable $th) {
            info($th);
            abort(500);
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        try {

            return view('components.modal-edit-product', compact('product'));

        } catch (\Throwable $th) {
            info($th);
            abort(500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
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
            info($e);
            return redirect()->route('product')->with('error', 'Gagal memperbarui data. Silakan coba lagi.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            DB::beginTransaction();

            $product->delete();

            $products = Product::orderBy('id')->get();
            $count = $products->count();

            DB::commit();

            if ($count == 0) {
                return redirect()->route('product')->with('success', 'Produk berhasil dihapus');
            } else {
                $lastProducts = $products->last();
                return redirect()->route('products.show', $lastProducts->id)->with('success', 'Produk berhasil dihapus');
            }

        } catch (\Exception $e) {
            Log::error('Error deleting product: ' . $e->getMessage());
            DB::rollBack();
            return Redirect::to(route('product'))->with('error', 'Gagal menghapus produk.');
        }
    }

    public function duplicate(Product $product)
    {
        try {
            DB::beginTransaction();

            Product::create([
                'name' => $product->name . "-copy",
                'icon' => $product->icon,
                'label' => $product->label,
                'start_date' => $product->start_date,
                'end_date' => $product->end_date,
                'user_id' => $product->user_id,
            ]);

            DB::commit();

            return redirect()->route('product')->with('success', 'Berhasil duplikasi.');

        } catch (\Exception $e) {
            Log::error('Error duplicate product: ' . $e->getMessage());
            DB::rollBack();
            return Redirect::to(route('product'))->with('error', 'Gagal duplikasi.');
        }
    }
}
