<?php

namespace app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function patients()
    {
        $users = User::where('role', 'patient')->get();
        return view('users.index', compact('users'));
    }

    public function doctors()
    {
        $users = User::where('role', 'doctor')->get();
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'role' => 'required',
            'password' => 'required|min:6'
        ]);

        User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => bcrypt($request->password),
        ]);

        return back()->with('success', 'User created');
    }

    public function update(Request $request, User $user)
    {
        $user->update($request->only('first_name', 'last_name', 'email', 'is_active'));

        return back()->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User deleted');
    }
    public function search(Request $request)
    {
        $q = $request->q;
        $role = $request->role;

        $users = User::query();

        if ($role) {
            $users->where('role', $role);
        }

        if ($q) {
            $users->where(function ($query) use ($q) {
                $query->where('first_name', 'like', "%$q%")
                    ->orWhere('last_name', 'like', "%$q%")
                    ->orWhere('email', 'like', "%$q%");
            });
        }

        return response()->json($users->get());
    }
}