<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managers = Manager::with('branch')->paginate(10);
        return view('managers.index', compact('managers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('managers.create', compact('branches'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|string|max:255',
            'branch_id' => 'required|exists:branches,id',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:managers',
            'phone' => 'required|string|max:20',
        ]);
        Manager::create($request->all());
        return redirect()->route('managers.index')->with('success', 'Manager created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Manager $manager)
    {
        return view('managers.show', compact('manager'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Manager $manager)
    {
        $branches = Branch::all();
        return view('managers.edit', compact('manager', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Manager $manager)
    {
        $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'branch_id' => 'sometimes|required|exists:branches,id',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:managers,email,' . $manager->id,
            'phone' => 'sometimes|required|string|max:20',
        ]);
        $manager->update($request->all());
        return redirect()->route('managers.index')->with('success', 'Manager updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Manager $manager)
    {
        $manager->delete();
        return redirect()->route('managers.index')->with('success', 'Manager deleted successfully.');
    }

    /**
     * Search for resources.
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $managers = Manager::with('branch')
            ->where('first_name', 'LIKE', "%{$search}%")
            ->orWhere('last_name', 'LIKE', "%{$search}%")
            ->orWhere('email', 'LIKE', "%{$search}%")
            ->orWhere('phone', 'LIKE', "%{$search}%")
            ->paginate(10);
        return view('managers.index', compact('managers'));
    }
}
