<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sprint;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSprintRequest;

class SprintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $product = Product::findOrFail($id);
        $sprints = Sprint::with('product')->where('product_id', $id)->latest()->get();
        foreach ($sprints as $sprint) {
            $sprint->description = Str::limit($sprint->description, 15);
            $sprint->result_review = Str::limit($sprint->result_review, 15);
            $sprint->result_retrospective = Str::limit($sprint->result_retrospective, 15);

            $start_date = Carbon::parse($sprint->start_date);
            $start_date_formatted = $start_date->format('d F Y H:i');
            $sprint->start_date = $start_date_formatted;

            $end_date = Carbon::parse($sprint->end_date);
            $end_date_formatted = $end_date->format('d F Y H:i');
            $sprint->end_date = $end_date_formatted;

            $sprint->status = $sprint->status == 'active' ? "danger" : "success";
        }
        return view('pages.sprints.index', compact('product', 'sprints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('pages.sprints.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSprintRequest $request, $id)
    {
        try {
            $status = $request->status == 'inactive' ? 'inactive' : 'active';

            Sprint::create([
                'name' => $request->name,
                'description' => $request->description,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $status,
                'result_review' => $request->result_review,
                'result_retrospective' => $request->result_retrospective,
                'product_id' => $id,
            ]);
            return redirect()->route('sprints.index', $id)->with(['success' => 'Berhasil disimpan.']);
        } catch (\Throwable $th) {
            return redirect()->route('sprints.index', $id)->with(['error' => 'Gagal disimpan.']);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id, $sprintId)
    {
        $sprint = Sprint::findOrFail($sprintId);
        $productId = $id;
        return view('pages.sprints.show', compact('productId', 'sprint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $sprintId)
    { 
        $sprint = Sprint::findOrFail($sprintId);
        $productId = $id;

        $sprint->start_date = Carbon::parse($sprint->start_date)->format('d F Y, H:i');
        $sprint->end_date = Carbon::parse($sprint->end_date)->format('d F Y, H:i');
        
        return view('pages.sprints.update', compact('productId', 'sprint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $sprintId)
{
    //dd($request->all());
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'start_date' => 'required|date',
        'end_date' => 'required|date|after:start_date',
        'status' => 'required|string',
        'result_review' => 'nullable|string',
        'result_retrospective' => 'nullable|string',
    ]);

    Log::info('Start Date:', [$request->start_date]);
    Log::info('End Date:', [$request->end_date]);

    try {
        $sprint = Sprint::findOrFail($sprintId);

        $sprint->update([
            'name' => $request->name,
            'description' => $request->description,
            'start_date' => Carbon::parse($request->start_date)->format('Y-m-d H:i:s'), 
            'end_date' => Carbon::parse($request->end_date)->format('Y-m-d H:i:s'),
            'status' => $request->status,
            'result_review' => $request->result_review,
            'result_retrospective' => $request->result_retrospective,
        ]);

        return redirect()->route('sprints.index', $id)->with(['success' => 'Berhasil diperbarui.']);
    } catch (\Throwable $th) {
        return redirect()->route('sprints.index', $id)->with(['error' => 'Gagal diperbarui.']);
    }
}


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $sprintId)
    {
        try {
            $sprint = Sprint::findOrFail($sprintId);
            $sprint->delete();

            return redirect()->route('sprints.index', $id)->with(['success' => 'Berhasil dihapus.']);
        } catch (\Exception $e) {
            LOG::error('Error Deleting Sprint:' . $e->getMessage());
            return redirect()->route('sprints.index', $id)->with(['error' => 'Gagal dihapus.']);
        }
    }
}
