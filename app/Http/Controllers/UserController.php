<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class UserController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {  
        $this->authorize('manageUser', User::class);
        $users=User::all();
        return view('users.index' , compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {   
        $this->authorize('manageUser', User::class);
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
        $this->authorize('manageUser', User::class); 
        
        $request->validate([
            'name' => 'string|required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required',
        ]);

        User::create([
        'name' => $request->name ,
        'email' => $request->email ,
        'password' => $request->password ,
        ]);

        return redirect()->route("users.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    { 
        $this->authorize('manageUser', User::class);
        return view('users.show' , compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {   
        $this->authorize('manageUser', User::class);
        return view('users.edit' , compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {   
        $this->authorize('manageUser', User::class);

        $request->validate([
            'name' => 'string|required',
            'email' => 'email|required|unique:users,email',
            'password' => 'required',
        ]);
        
        $user->update([
            'name' => $request->name ,
            'email' => $request->email ,
            'password' => $request->password ,
            ]);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('manageUser', User::class);
        $user->delete();
        return redirect()->route('users.index');
    }
}
