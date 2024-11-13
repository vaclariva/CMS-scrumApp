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
    // public function index($id)
    // {
    //     try {
    //         $product = Product::findOrFail($id);
    //         $vision_boards = VisionBoard::with('product')->where('product_id', $id)->latest()->get();
            
    //         return view('pages.vision-boards.detail-product', compact('vision_boards', 'product'));
    //     } catch (\Throwable $th) {
    //         info($th);
    //         abort(500);
    //     }
    // }

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
            DB::beginTransaction();
                
            $request->validate([
                'product_id' => 'required|exists:products,id',
                'name' => 'required|string|max:255',
            ]);

            VisionBoard::create([
                'product_id' => $request->product_id,
                'name' => $request->name,
            ]);

            DB::commit();

            return redirect()->back()->with('success', 'Vision board berhasil ditambahkan');

        } catch (\Exception $e) {
            DB::rollBack();
            info($e);
            abort(500);
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
    public function update(Request $request, Product $product, VisionBoard $visionBoard)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'vision' => 'nullable|string|max:500',
            'target_group' => 'nullable|string|max:255',
            'needs' => 'nullable|string|max:500',
            'product' => 'nullable|string|max:255',
            'business_goals' => 'nullable|string|max:500',
            'competitors' => 'nullable|string|max:500',
        ]);

        try {
            DB::beginTransaction();

            $visionBoard->update($request->only([
                'name', 'vision', 'target_group', 'needs', 'product', 'business_goals', 'competitors'
            ]));

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Vision Board berhasil diperbarui.',
                'data' => $visionBoard  
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Error update Vision Board for Product ID ' . $product->id . ': ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui Vision Board. Silakan coba lagi.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateTitle(Request $request, Product $product, VisionBoard $visionBoard)
    {
        try {
            DB::beginTransaction();

            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $visionBoard->update($request->only(['name']));

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil diupdate.',
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            
            Log::error('Error update Vision Board for Product ID ' . $product->id . ': ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memperbarui Vision Board. Silakan coba lagi.',
                'error' => $e->getMessage()
            ], 500);
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

            DB::beginTransaction();

            VisionBoard::create([
                'product_id' => $visionBoard->product_id,
                'name' => $visionBoard->name . "-copy",
                'vision' => $visionBoard->vision,
                'target_group' => $visionBoard->target_group,
                'needs' => $visionBoard->needs,
                'product' => $visionBoard->product,
                'business_goals' => $visionBoard->business_goals,
                'competitors' => $visionBoard->competitors,
            ]);

            DB::commit();

            return redirect()->route('products.show', $product->id )->with('success', 'Berhasil duplikasi.');
        } catch (\Exception $e) {
            Log::error('Error duplicate Vision Board: ' . $e->getMessage());
            DB::rollBack();
            return Redirect::to(route('products.show', $product->id ))->with('error', 'Gagal duplikasi.');
        }
    }

    public function competitors(VisionBoard $visionBoard)
    {
        try {

            // Cari item berdasarkan ID
            
            if ($visionBoard) {
                // Kosongkan kolom competitors
                $visionBoard->competitors = null;
                $visionBoard->save();

                // Mengembalikan response sukses
                return response()->json(['message' => 'Competitors (Pesaing) telah dihapus!']);
            }

            // Jika vision_boards tidak dvision_boardsukan
            return response()->json(['message' => 'vision_boards tidak ditemukan!'], 404);
        } catch (\Throwable $th) {
            info($th);
            return response()->json(['message' => 'Competitors (Pesaing) gagal dihapus'], 500);
        }
    }
}
