<?php

namespace App\Http\Controllers;

use App\Jobs\CustomerCreatedEmailJob;
use App\Models\Branch;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::with('branch')->paginate(10);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $branches = Branch::all();
        return view('customers.create', compact('branches'));
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
            'email' => 'required|string|email|max:255|unique:customers',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'state' => 'required|string|max:255',
            'profile_photo' => 'sometimes|image|max:2048'
        ]);

        if ($request->hasFile('profile_photo')) {
            // $file = $request->file('profile_photo');
            // $filename = time() . '_' . $file->getClientOriginalName();
            // $file->move(public_path('images'), $filename);
            // $data['profile_photo'] = $filename;
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photo', 'public');
        }
        $data = $request->all();
        $customer = Customer::create($data);
        CustomerCreatedEmailJob::dispatch($customer);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
        return view('customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        $branches = Branch::all();
        return view('customers.edit', compact('customer', 'branches'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name' => 'sometimes|required|string|max:255',
            'branch_id' => 'sometimes|required|exists:branches,id',
            'last_name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|string|email|max:255|unique:customers,email,' . $customer->id,
            'phone' => 'sometimes|required|string|max:20',
            'address' => 'sometimes|required|string|max:255',
            'city' => 'sometimes|required|string|max:255',
            'state' => 'sometimes|required|string|max:255',
            'profile_photo' => 'sometimes|image|max:2048'
        ]);

        $data = $request->all();
        if ($request->hasFile('profile_photo')) {
            // $file = $request->file('profile_photo');
            // $filename = time() . '_' . $file->getClientOriginalName();
            // $file->move(public_path('images'), $filename);
            // $data['profile_photo'] = $filename;
            $data['profile_photo'] = $request->file('profile_photo')->store('profile_photo', 'public');
        }
        $customer->update($data);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully.');
    }
}
