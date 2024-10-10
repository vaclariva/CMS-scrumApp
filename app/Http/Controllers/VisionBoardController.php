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
    public function index($id)
    {
        $product = Product::findOrFail($id);
        $vision_boards = VisionBoard::with('product')->where('product_id', $id)->latest()->get();
        
        return view('pages.vision-boards.detail-product', compact('vision_boards', 'product'));
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
            'name' => 'required|string|max:255',
            'vision' => 'nullable|string',
            'target_group' => 'nullable|string',
            'needs' => 'nullable|string',
            'product' => 'nullable|string',
            'business_goals' => 'nullable|string',
            'competitors' => 'nullable|string',
        ]);

        try {
            DB::beginTransaction();

            $visionBoard->update([
                'name' => $request->input('name'),
                'vision' => $request->input('vision'),
                'target_group' => $request->input('target_group'),
                'needs' => $request->input('needs'),
                'product' => $request->input('product'),
                'business_goals' => $request->input('business_goals'),
                'competitors' => $request->input('competitors'),
            ]);

            DB::commit();

            return redirect()->route('products.show', $product->id)
                            ->with('success', 'Vision Board berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error update Vision Board: ' . $e->getMessage());

            return redirect()->route('products.show', $product->id)
                            ->with('error', 'Gagal memperbarui Vision Board. Silakan coba lagi.');
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
