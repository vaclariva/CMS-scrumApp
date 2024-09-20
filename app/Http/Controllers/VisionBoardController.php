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
        
            $visionBoard->update([
                'product_id' => $request->product_id,
                'name' => $request->name,
                'vision' => $request->vision,
                'target_group' => $request->target_group,
                'needs' => $request->needs,
                'product' => $request->product,
                'business_goals' => $request->business_goals,
                'competitors' => $request->competitors,
            ]);

            DB::commit();
            return redirect()->route('products.show', $product->id)->with('success', 'Produk berhasil diperbarui');
        } catch (\Exception $e) {
            Log::error('Update failed: ' . $e->getMessage());
            DB::rollBack();
            return redirect()->route('detail-product')->with('error', 'Gagal memperbarui data. Silakan coba lagi.');
        }
    }




    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::beginTransaction();

        try {
            $visionBoard = VisionBoard::findOrFail($id);
            $visionBoard->delete();

            DB::commit();
            return redirect()->route('detail-product')->with('success', 'Vision board deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete failed: ' . $e->getMessage());

            return redirect()->route('detail-product')->with('error', 'Failed to delete vision board. Please try again.');
        }
    }
}
