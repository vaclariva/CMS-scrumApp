<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Checklist;
use Illuminate\Http\Request;

class ChecklistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function index($backlogId)
    {
        $backlog = Backlog::findOrFail($backlogId);

        $checklist = Checklist::where('backlog_id', $backlogId)->get();

        return view('pages.vision-boards.detail-product', compact('backlog', 'checklist'));
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
            'backlog_id' => 'required|exists:backlogs,id',
            'name' => 'required|string|max:255',
        ]);

        Checklist::create([
            'backlog_id' => $request->backlog_id,
            'name' => $request->name,
        ]);

        return redirect()->back()->with('success', 'Vision board berhasil ditambahkan');
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
    public function update(Request $request, $checklistId)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:0,1',
        ]);

        $checklist = Checklist::findOrFail($checklistId);

        $checklist->update([
            'name' => $request->name,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return redirect()->back()->with('success', 'Checklist berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
