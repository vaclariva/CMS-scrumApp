<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\VisionBoard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisionBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId)
    {
        $product = Product::findOrFail($productId);
        
        $vision_boards = $product->vision_board; 

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
    public function store(Request $request, $product_id)
    {
        //dd($request->all());
        $request->validate([
            'name' => 'required|string|max:255',
            'vision' => 'required|string',
            'target_group' => 'required|string',
            'needs' => 'required|string',
            'product' => 'required|string',
            'business_goals' => 'required|string',
            'competitors' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            VisionBoard::create([
                'name' => $request->input('name'),
                'vision' => $request->input('vision'),
                'target_group' => $request->input('target_group'),
                'needs' => $request->input('needs'),
                'product' => $request->input('product'),
                'business_goals' => $request->input('business_goals'),
                'competitors' => $request->input('competitors'),
                'product_id' => $product_id,  
            ]);

            DB::commit();

            return redirect()->route('pages.detail-product', $product_id)
                            ->with('success', 'Vision Board berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'Failed to create Vision Board. Please try again.']);
        }
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
    public function update(Request $request, $productId, $id)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            // Validasi lainnya jika diperlukan
        ]);

        // Temukan vision board berdasarkan ID
        $vision_board = VisionBoard::findOrFail($id);

        // Update vision board dengan data baru
        $vision_board->update([
            'name' => $request->input('name'),
            // Kolom lain yang ingin diperbarui
        ]);

        return redirect()->route('vision_boards.index', $productId)->with('success', 'Vision Board updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($productId, $id)
    {
        // Temukan vision board berdasarkan ID
        $vision_board = VisionBoard::findOrFail($id);

        // Hapus vision board
        $vision_board->delete();

        return redirect()->route('vision_boards.index', $productId)->with('success', 'Vision Board deleted successfully');
    }
}
