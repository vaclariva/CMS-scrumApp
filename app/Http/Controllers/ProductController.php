<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

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
            'name'=> 'required',
            'label'=> 'required',
            'start_date'=> 'required|date',
            'end_date'=> 'required|date|after_or_equal:start_date',
            'user_id'=> 'required|exists:users,id',
        ]);

        try{
            Product::create($request->all());
            return redirect()->route('product')->with('success', 'Produk berhasil ditambahkan');
        }catch(\Exception $e) {
            return redirect()->route('product')->with('error', 'Gagal menghapus data. Silakan coba lagi.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
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
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
