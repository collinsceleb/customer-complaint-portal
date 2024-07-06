<?php

namespace App\Http\Controllers;

use App\Jobs\ManagerCreatedEmailJob;
use App\Models\Branch;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
        $users =
        User::whereDoesntHave('roles', function ($query) {
            $query->where('name', 'manager');
        })->get();
        return view('managers.create', compact('branches', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->has('existing_user')) {
            $request->validate([
                'existing_user' => 'required|exists:users,id',
                'branch_id' => 'required|exists:branches,id',
            ]);
            $user = User::find($request->existing_user);
            $nameParts = explode(' ', $user->name);
            $firstName = $nameParts[0] ?? '';
            $lastName = $nameParts[1] ?? '';
            $user->assignRole('manager');
             $manager = new Manager([
            'first_name' => $firstName,
            'branch_id' => $request->branch_id,
            'last_name' => $lastName,
            'email' => $user->email,
            'phone' => $user->phone,
            'user_id' => $user->id,
            ]);
            $manager->save();
            return redirect()->route('managers.index')->with('success', 'Manager has been assigned successfully.');
        } else {
            $password = Str::password(10, true, true, true, false);
            $request->validate([
                'first_name' => 'required|string|max:255',
                'branch_id' => 'required|exists:branches,id',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:managers',
                'phone' => 'required|string|max:20',
            ]);
            $user = User::create([
                'name' => $request->first_name . ' ' . $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($password),
            ]);

            $user->assignRole('manager');
            ManagerCreatedEmailJob::dispatch($user, $password, $request->branch_id);
            $manager = new Manager([
                'first_name' => $request->first_name,
                'branch_id' => $request->branch_id,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'user_id' => $user->id,
            ]);
            $manager->save();
            return redirect()->route('managers.index')->with('success', 'Manager created successfully.');
        }
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
