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

        $checklists = Checklist::where('backlog_id', $backlogId)->get();

        return view('pages.vision-boards.detail-product', compact('backlog', 'checklists'));
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

     public function store(Request $request, $backlogId)
    {
        $checklist = new Checklist();
        $checklist->backlog_id = $backlogId;
        $checklist->description = $request->input('description', 'untitled');
        $checklist->status = 0; 
        $checklist->save();

        
        $backlog = Backlog::findOrFail($backlogId); 

        $checklists = $backlog->checklists; 

        $completedChecklists = $backlog->checklists()->where('status', '1')->count();
        $totalChecklists = $backlog->checklists()->count();

        $persentase = $totalChecklists > 0 ? ($completedChecklists / $totalChecklists) * 100 : 0;

        return response()->json([
            'id' => $checklist->id,
            'description' => $checklist->description,
            'status' => $checklist->status,
            'completedChecklists' => $completedChecklists,
            'totalChecklists' => $totalChecklists,
            'persentase' => number_format($persentase, 2),
            'checklists' => $checklists,
            'message' => 'Checklist berhasil ditambahkan.'
        ]);

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
    public function update(Request $request, Checklist $checklist)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:0,1',
            'description' => 'nullable|string',
        ]);

        $checklist->status = $validatedData['status'];

        if (array_key_exists('description', $validatedData) && $validatedData['description'] !== null) {
            $checklist->description = $validatedData['description'];
        }

        $checklist->save();

        $backlog = $checklist->backlog;
        $completedChecklists = $backlog->checklists()->where('status', '1')->count();
        $totalChecklists = $backlog->checklists()->count();

        $persentase = $totalChecklists > 0 ? ($completedChecklists / $totalChecklists) * 100 : 0;

        return response()->json([
            'id' => $checklist->id,
            'description' => $checklist->description,
            'status' => $checklist->status,
            'completedChecklists' => $completedChecklists,
            'totalChecklists' => $totalChecklists,
            'persentase' => number_format($persentase),
            'backlog' => $backlog,
        ]);
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, string $backlogId)
    {
        $checklist = Checklist::findOrFail($id); 

        $checklist->delete(); 

        $backlog = $checklist->backlog;

        $checklists = $backlog->checklists()->where('backlog_id', $backlogId)->get();
        $completedChecklists = $backlog->checklists()->where('status', '1')->count();
        $totalChecklists = $backlog->checklists()->count();

        $persentase = $totalChecklists > 0 ? ($completedChecklists / $totalChecklists) * 100 : 0;

        return response()->json([
            'message' => 'Checklist deleted successfully.',
            'completedChecklists' => $completedChecklists,
            'totalChecklists' => $totalChecklists,
            'checklists' => $checklists,
            'persentase' => number_format($persentase),
            'backlog' => $backlog,
        ]);
    }
}
