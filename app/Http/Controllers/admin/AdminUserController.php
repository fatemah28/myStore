<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminUserController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function showUsers()
    {
        $users = User::get();
        return view('dashboard.users.index', compact('users'));
    }
    public function adminCreateUser()
    {
        return view('dashboard.users.create');
    }
    public function adminUserStore(Request $request)
    {
        // dd($request);
        $user = new User();
        $user->name = $request->name;
        $user->full_name = $request->full_name;
        $user->role = $request->role;
        $user->email = $request->email;
        $user->password = $request->email;
        // $imageUrl = $request->file('image')->store('users', 'public');
        $user->image = '/users/default.jpeg';
        $user->save();
        return redirect()->route('adminUsers')->with('message', "User Created Successfully");
    }
    public function adminEditUser($id)
    {
        $user = User::find($id);
        if ($user) {
            return view('dashboard.users.edit', compact('user'));
        } else {
            return "you should to be auth";
        }
    }
    public function adminUserUpdate(Request $request, $id)
    {
        $user = User::find($id);
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($user->image);
            $imageUrl = $request->file('image')->store('users', 'public');
            $user->update([
                'image' => $imageUrl,
            ]);
        }
        $user->update([
            'name' => $request->name,
            'full_name' => $request->full_name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect()->route('adminUsers')->with('message', 'User Updated Successfully');
    }
    public function adminDeleteUser($id)
    {
        $user = User::find($id);
        return view('dashboard.users.delete', compact('user'));
    }
    public function adminUserDestroy($id)
    {
        $user = User::find($id);

        $user->delete();
        return redirect()->route('adminUsers')->with('message', 'User Deleted Successfully');
    }
}
