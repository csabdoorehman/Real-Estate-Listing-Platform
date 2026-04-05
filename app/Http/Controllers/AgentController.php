<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AgentController extends Controller
{
    public function show(User $agent)
    {
        if ($agent->role !== 'agent') {
            abort(404);
        }

        $properties = $agent->properties()->latest()->paginate(6);
        return view('agents.show', compact('agent', 'properties'));
    }

    public function edit()
    {
        return view('agents.edit');
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'profile_image' => 'nullable|image|max:1024',
        ]);

        if ($request->hasFile('profile_image')) {
            $path = $request->file('profile_image')->store('profiles', 'public');
            $validated['profile_image'] = $path;
        }

        auth()->user()->update($validated);

        return back()->with('success', 'Profile updated successfully!');
    }
}
