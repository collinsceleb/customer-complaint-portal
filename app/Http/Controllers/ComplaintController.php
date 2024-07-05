<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Complaint;
use App\Models\Customer;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::with(['customer', 'branch'])->paginate(10);
        return view('complaints.index', compact('complaints'));
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
            'customer_id' => 'required|exists:customers, id',
            'branch_id' => 'required|exists:branches, id',
            'reviewed' => 'required|boolean',
            'message' => 'required|string',
            'title' => 'required|string|max:255'
        ]);

        Complaint::create($request->all());

        return redirect()->route('complaints.index')->with('success', 'Complaint created successfully');
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
