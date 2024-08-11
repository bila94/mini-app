<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use AuthorizesRequests;
    public function index()
    {
        $users = User::with('userMeta.country')->get();
        return view('users.index', compact('users'));
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        $countries = \App\Models\Country::all();
        return view('users.edit', compact('user', 'countries'));
    }
    
    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);
    
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            'address' => ['nullable', 'string', 'max:255'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'city' => ['nullable', 'string', 'max:255'],
            'province' => ['nullable', 'string', 'max:255'],
            'country_id' => ['required', 'exists:countries,id'],
        ]);
    
        $user->update($request->only(['name', 'surname', 'email']));
    
        if (auth()->user()->is_admin) {
            $user->update(['is_admin' => $request->boolean('is_admin', false)]);
        }
    
        $user->userMeta()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only(['address', 'zip_code', 'city', 'province', 'country_id'])
        );
    
        return redirect()->route('users.show', $user)->with('success', 'User updated successfully');
    }
    
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully');
    }
}