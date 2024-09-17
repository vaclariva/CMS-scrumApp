<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\VisionBoard;
use Illuminate\Http\Request;

class VisionBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId)
    {
        // Temukan product berdasarkan productId
        $product = Product::findOrFail($productId);
        
        // Ambil semua vision_boards yang berhubungan dengan produk tersebut
        $vision_boards = $product->vision_board; // Harus tanpa kurung karena relasi hasMany

        // Kirimkan ke view
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
    public function store(Request $request, $productId)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            // Tambahkan validasi lain jika diperlukan
        ]);

        // Temukan produk berdasarkan ID
        $product = Product::findOrFail($productId);

        // Buat dan simpan vision board baru yang terkait dengan produk
        $vision_board = new VisionBoard([
            'name' => $request->input('name'),
            // Kolom lain yang diperlukan
        ]);

        $product->vision_board()->save($vision_board); // Simpan vision_board melalui relasi product

        return redirect()->route('vision_boards.index', $productId)->with('success', 'Vision Board added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
