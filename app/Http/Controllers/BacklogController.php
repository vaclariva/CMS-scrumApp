<?php

namespace App\Http\Controllers;

use App\Models\Backlog;
use App\Models\Checklist;
use App\Models\Product;
use App\Models\Sprint;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
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
        
        $sprints = Sprint::all();
        
        $backlogs = $product->backlogs()->where('sprint_id', $sprintId)->latest()->with('user')->get();

        return view('pages.vision-boards.detail-product', compact('backlogs', 'product', 'sprints'));
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

        $product = Product::findOrFail($request->product_id);

        Log::info('Menciptakan backlog baru', [
            'product_id' => $product->id,
            'name' => $request->name,
            'user_id' => $product->user_id,
        ]);

        try {
            Backlog::create([
                'product_id' => $product->id,
                'name' => $request->name,
                'user_id' => $product->user_id,
            ]);

            Log::info('Backlog berhasil ditambahkan', [
                'backlog_id' => $product->id,
            ]);

            return redirect()->back()->with('success', 'Backlog berhasil ditambahkan');
        } catch (\Exception $e) {
            Log::error('Gagal menambahkan backlog', [
                'error' => $e->getMessage(),
                'product_id' => $product->id,
                'name' => $request->name,
            ]);

            return redirect()->back()->with('error', 'Backlog gagal ditambahkan');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show($id, $backlogId)
    {
        $backlog = Backlog::with('checklists')->findOrFail($id); 
        $sprints = Sprint::with('backlog')->where('backlog_id', $backlogId)->latest()->get();
        return view('backlogs.show', compact('backlog', 'sprints'));
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
        
        $checklists = $backlog->checklists()->where('backlog_id', $backlog->id)->get();
        $sprints = $product->sprints()->get();
        
        info('Checklists for backlog: ', $checklists->toArray());
        
        return response()->json([
            'success' => true,
            'product' => $product,
            'backlog' => $backlog,
            'checklists' => $checklists,
            'sprints' => $sprints,
        ]);
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $productId, $backlogId)
    {
        $request->merge([
            'product_id' => $productId, 
        ]);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'priority' => 'nullable|string',
            'hours' => 'nullable|numeric',
            'applicant' => 'nullable|string',
            'status' => 'required|in:0,1', 
            'sprint_id' => 'nullable|exists:sprints,id',
            'product_id' => 'required|exists:products,id',
        ]);

        $backlog = Backlog::findOrFail($backlogId);

        $backlog->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'priority' => $request->input('priority'),
            'hours' => $request->input('hours'),
            'applicant' => $request->input('applicant'),
            'status' => $request->input('status'),
            'sprint_id' => $request->input('sprint_id'),
            'product_id' => $productId,
        ]);

        $groupedBacklogs = Backlog::with('product')
            ->where('product_id', $productId)
            ->latest()
            ->get()
            ->groupBy('sprint_id')
            ->sortKeysDesc();

        return response()->json([
            'success' => true,
            'id' => $backlog->id,
            'name' => $backlog->name,
            'priority' => $backlog->priority,
            'description' => $backlog->description,
            'hours' => $backlog->hours,
            'applicant' => $backlog->applicant,
            'status' => $backlog->status,
            'checklist_complete' => $backlog->checklists->where('status', 1)->count(),
            'checklist_total' => $backlog->checklists->count(),
            'product_id' => $backlog->product_id,
            'sprint_id' => $backlog->sprint_id,
            'backlog' => $backlog,
            'groupedBacklogs' => $groupedBacklogs,
            'csrf_token' => csrf_token(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */

    public function updateTitle(Request $request, Product $product, Backlog $backlog)
    {
        try {

            DB::beginTransaction();
            $request->validate([
                'name' => 'required|string|max:255',
            ]);

            $backlog->update([
                'name' => $request->input('name'),
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Berhasil disimpan.',
            ]);
        } catch (\Exception $e) {
            info($e);
            DB::rollBack();
            return response()->json([
                'message' => 'Gagal disimpan.',
            ], 500);
        }        
    }

    public function storeOrUpdateChecklist(Request $request, $backlog_id)
    {       
        $request->validate([
            'checklist_id' => 'nullable|integer',
            'description' => 'required|string',
            'status' => 'nullable|boolean'
        ]);

        if ($request->checklist_id) {
            $checklist = Checklist::find($request->checklist_id);
            if ($checklist) {
                $checklist->update([
                    'description' => $request->description,
                    'status' => $request->status ?? false,
                ]);

                $backlog = $checklist->backlog;
                $completedChecklists = $backlog->checklists()->where('status', '1')->count();
                $totalChecklists = $backlog->checklists()->count();

                $persentase = $totalChecklists > 0 ? ($completedChecklists / $totalChecklists) * 100 : 0;

                return response()->json([
                    'id' => $checklist->id,
                    'description' => $checklist->description,
                    'status' => $checklist->status,
                    'message' => 'Checklist berhasil ditambahkan.'
                        ], 200);
            }
        }

        
        $backlog = Backlog::find($backlog_id);
        $checklist = $backlog->checklists()->create([
            'description' => $request->description,
            'status' => $request->status ?? false, 
        ]);

        $checklists = $backlog->checklists; 

        $completedChecklists = $backlog->checklists()->where('status', '1')->count();
        $totalChecklists = $backlog->checklists()->count();

        $persentase = $totalChecklists > 0 ? ($completedChecklists / $totalChecklists) * 100 : 0;

        return response()->json([
            'checklist'=> $checklist,
            'completedChecklists' => $completedChecklists,
            'totalChecklists' => $totalChecklists,
            'persentase' => number_format($persentase, 2),
            'backlog' => $backlog,
            'message' => 'Checklist berhasil ditambahkan.'
        ], 201);
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
                'user_id' => $backlog->user_id,
                'name' => $backlog->name . "-copy",
                'description' => $backlog->description,
                'priority' => $backlog->priority,
                'hours' => $backlog->hours,
                'applicant' => $backlog->applicant,
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

    public function download($backlog_id)
    {
        $backlog = Backlog::with(['checklists', 'sprint', 'user'])->findOrFail($backlog_id);

        $data = [
            'productName' => $backlog->product->name,
            'hariTanggal' => Carbon::parse($backlog->created_at)->isoFormat('dddd, D MMMM YYYY'),
            'userStory' => $backlog->name,
            'acceptanceCriteria' => $backlog->checklists,
            'keterangan' => $backlog->description,
            'applicant' => $backlog->applicant,
            'backlog' => $backlog,
        ];

        $pdf = Pdf::loadView('pages.backlogs.partials.download', $data);

        $pdf->setPaper('A4', 'portrait');
        
        $pdf->getDomPDF()->set_option('isHtml5ParserEnabled', true);
        $pdf->getDomPDF()->set_option('isRemoteEnabled', true);

        return $pdf->download('Backlog_' . $backlog->id . '.pdf');
    }
}  
