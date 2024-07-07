<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Complaint;
use App\Models\Customer;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $complaints = Complaint::with('customer', 'branch')->select('complaints.*');

            return DataTables::of($complaints)
            ->addColumn('customer_name', function ($complaint) {
                return $complaint->customer->user->name;
            })
            ->addColumn('branch_name', function ($complaint) {
                return $complaint->branch->name;
            })
            ->addColumn('message', function ($complaint) {
                return $complaint->message;
            })
            ->addColumn('title', function ($complaint) {
                    return $complaint->title;
                })
            ->addColumn('status', function ($complaint) {
                return $complaint->reviewed ? 'Reviewed' : 'Pending';
            })
            ->addColumn('actions', function ($complaint) {
                return view('partials.actions', ['model' => $complaint, 'route' => 'complaints']);
            })
            ->make(true);
        }
        return view('complaints.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::all();
        $branches = Branch::all();
        return view('complaints.create', compact('customers', 'branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'customer_id' => 'required|exists:customers,id',
            'branch_id' => 'required|exists:branches,id',
        ]);

        Complaint::create([
            'title' => $request->title,
            'message' => $request->message,
            'reviewed' => $request->reviewed ?? false,
            'customer_id' => $request->customer_id,
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('complaints.index')->with('success', 'Complaint created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(Complaint $complaint)
    {
        return view('complaints.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Complaint $complaint)
    {
        $customers = Customer::all();
        $branches = Branch::all();
        return view('complaints.edit', compact('complaint', 'customers', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Complaint $complaint)
    {
        $request->validate([
            'customer_id' => 'sometimes|required|exists:customers, id',
            'branch_id' => 'sometimes|required|exists:branches, id',
            'reviewed' => 'sometimes|required|boolean',
            'message' => 'sometimes|required|string',
            'title' => 'sometimes|required|string|max:255'
        ]);

        $complaint->update($request->all());

        return redirect()->route('complaints.index')->with('success', 'Complaint created successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Complaint $complaint)
    {
        $complaint->delete();
        return redirect()->route('complaints.index')->with('success', 'Complaint deleted successfully');
    }
}
