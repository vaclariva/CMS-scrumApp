<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Checklist;
use App\Models\Product;
use App\Models\Sprint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class BacklogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($productId, $sprintId)
    {
        $product = Product::findOrFail($productId);
        $sprint = Sprint::findOrFail($sprintId);

        $backlogs = $product->backlogs()->where('sprint_id', $sprintId)->latest()->get();

        return view('pages.vision-boards.detail-product', compact('backlogs', 'product', 'sprint'));
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

        Backlog::create([
            'product_id' => $request->product_id,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Vision board berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $backlog = Backlog::with('checklists')->findOrFail($id); 
        return view('backlogs.show', compact('backlog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Product $product, Backlog $backlog)
    {
        info('Editing product and backlog', [
            'product' => $product,
            'backlog' => $backlog,
        ]);
        

        $checklists = $backlog->checklists()->get();
        
        return redirect()->back()->with('success', 'Backlog berhasil ditampilkan');
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'product_id' => 'required|exists:products,id',
        ]);

        $backlog = Backlog::findOrFail($id);
        $backlog->update([
            'name' => $request->name,
            'description' => $request->description,
            'priority' => $request->priority,
            'hours' => $request->hours,
            'status' => $request->status ?? '0',
        ]);

        return redirect()->back()->with('success', 'Backlog berhasil diperbarui');
    }

    public function storeOrUpdateChecklist(Request $request, $backlog_id)
    {       
        $request->validate([
            'checklist_id' => 'nullable',
            'description' => 'required|string',
            'status' => 'nullable|boolean'
        ]);

        $checklist = Checklist::find($request->checklist_id)->first();

        if ($checklist) {
            $checklist->update([
                'description' => $request->description,
                'status' => $request->status ?? '0',
            ]);

            return response()->json([
                    'message' => 'Checklist berhasil diupdate.'
                ], 200);
        } else {
            $backlog = Backlog::find($backlog_id);
            $backlog->checklists()->create([
                'backlog_id' => $backlog_id,
                'description' => $request->description,
                'status' => $request->status ?? '0', 
            ]);

            return response()->json([
                    'message' => 'Checklist berhasil ditambahkan.'
                ], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product, Backlog $backlog)
    {
        try {
            DB::beginTransaction();

            $backlog->delete();

            DB::commit();

            return redirect()->route('products.show', $product->id)
                            ->with('success', 'Backlog berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Delete failed: ' . $e->getMessage());
            
            return redirect()->route('products.show', $product->id)
                            ->with('error', 'Backlog gagal dihapus');
        }
    } 

    public function duplicate(Product $product, Backlog $backlog)
    {
        try {
            DB::beginTransaction();

            $newBacklog = Backlog::create([
                'product_id' => $backlog->product_id,
                'sprint_id' => $backlog->sprint_id,
                'name' => $backlog->name . "-copy",
                'description' => $backlog->description,
                'priority' => $backlog->priority,
                'hours' => $backlog->hours,
                'status' => $backlog->status,
            ]);

            $checklists = $backlog->checklists;
            if ($checklists->isNotEmpty()) {
                foreach ($checklists as $checklist) {
                    Checklist::create([
                        'backlog_id' => $newBacklog->id,
                        'description' => $checklist->description,
                        'status' => $checklist->status,
                    ]);
                }
            }

            DB::commit();

            Log::info('New Vision Board and its Checklists created:', $newBacklog->toArray());

            return redirect()->route('products.show', $product->id)
                            ->with('success', 'Berhasil menduplikasi Backlog.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error duplicating Vision Board: ' . $e->getMessage());
            
            return Redirect::to(route('products.show', $product->id))
                            ->with('error', 'Gagal menduplikasi Vision Board.');
        }
    }

}  
