<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Sprint;
use App\Models\User;
use App\Models\VisionBoard;
use Illuminate\Http\Request;

class DetailProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Product $product, $id)
    {

        $products = Product::when(auth()->user()->role != 'Super Admin', function ($query) {
        $query->where('user_id', auth()->user()->id);
        })->latest()->get();
        $sprints = Sprint::with('product')->where('product_id', $id)->latest()->get();
        $productOwner = $product->user()->first();
        $vision_boards = $product->vision_boards()->latest()->get(); 


        return view('pages.vision-boards.detail-product', compact('backlogs', 'product', 'productOwner', 'vision_boards', 'sprints'));
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
        //
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
