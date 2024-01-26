<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\Invitation;
use Illuminate\Http\Request;
use Str;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index');
    }

    public function store(StoreUserRequest $request)
    {
        $invitation = Invitation::create([
            'tenant_id' => auth()->user()->current_tenant_id,
            'email' => $request->email,
            'token' => Str::random(40),
        ]);

        return redirect()->route('users.index')
            ->with('success', 'Invitation sent!');
    }
}
