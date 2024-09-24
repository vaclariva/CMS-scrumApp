<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\VisionBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class VisionBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        info($product);
        $vision_boards = $product->vision_boards; 
        
        return view('pages.detail-product', compact('vision_boards', 'product'));
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
// VisionBoardController.php
public function store(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'name' => 'required|string|max:255',
    ]);

    VisionBoard::create([
        'product_id' => $request->product_id,
        'name' => $request->name,
    ]);

    return redirect()->back()->with('success', 'Vision board berhasil ditambahkan');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //c
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product, VisionBoard $visionBoard)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'name' => 'required|string|max:255',
        'vision' => 'nullable|string|max:255',
        'target_group' => 'nullable|string|max:255',
        'needs' => 'nullable|string|max:255',
        'product' => 'nullable|string|max:255',
        'business_goals' => 'nullable|string|max:255',
        'competitors' => 'nullable|string|max:255',
    ]);

    try {
        DB::beginTransaction();

        $visionBoard->update($request->all());

        DB::commit();

        // Jika permintaan adalah AJAX, kirim respons JSON
        if ($request->ajax()) {
            return response()->json(['success' => true]);
        }

        return redirect()->route('products.show', $product->id)->with('success', 'Produk berhasil diperbarui');
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Update failed: ' . $e->getMessage());

        // Respons error untuk AJAX
        if ($request->ajax()) {
            return response()->json(['success' => false], 500);
        }

        return redirect()->route('detail-product')->with('error', 'Gagal memperbarui data. Silakan coba lagi.');
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, VisionBoard $visionBoard)
    {
        try {
            DB::beginTransaction();

            $visionBoard->delete();

            DB::commit();

            return redirect()->route('products.show', $product->id)
                            ->with('success', 'Vision Board berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete failed: ' . $e->getMessage());
            
            return redirect()->route('products.show', $product->id)
                            ->with('error', 'Gagal menghapus Vision Board. Silakan coba lagi.');
        }
    } 

    public function duplicate(Product $product, VisionBoard $visionBoard)
    {
        try {
            info($visionBoard);
            info('Product ID: ' . $visionBoard->product_id);

            $newVisionBoard = VisionBoard::create([
                'product_id' => $visionBoard->product_id,
                'name' => $visionBoard->name . "-copy",
                'vision' => $visionBoard->vision,
                'target_group' => $visionBoard->target_group,
                'needs' => $visionBoard->needs,
                'product' => $visionBoard->product,
                'business_goals' => $visionBoard->business_goals,
                'competitors' => $visionBoard->competitors,
            ]);


            Log::info('New Vision Board created:', $newVisionBoard->toArray());

            return redirect()->route('products.show', $product->id )->with('success', 'Berhasil duplikasi.');
        } catch (\Exception $e) {
            Log::error('Error duplicate Vision Board: ' . $e->getMessage());
            return Redirect::to(route('products.show', $product->id ))->with('error', 'Gagal duplikasi.');
        }
    }
}
