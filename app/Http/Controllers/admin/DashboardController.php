<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    public function showDashboardPage(){
        $sales=count(Cart::get());
        $products=count(Product::get());
        $users=count(User::get());
        $usersCartsItems=User::get();
        // dd($sales);
        return view('dashboard.dashboard',compact('sales','products','users','usersCartsItems'));
    }
    public function showProfilePage(){
        return view('dashboard.profile');
    }
    public function uploadPhoto(Request $request){
        // dd($request);
        if ($request->hasFile('image')) {
            // Storage::disk('public')->delete(auth()->user()->image);
            $user = Auth::user();
            $image = $request->file('image')->store('users', 'public');
            // Update user's profile image path
            $user->update([
                'image'=>$image
            ]);
    
            return response()->json([
                'status' => 'success',
                'profile_image_url' => Storage::url($user->image),
            ]);
        }
    
        return response()->json([
            'status' => 'error',
            'message' => 'Failed to upload profile image.',
        ], 500);
    }
    public function deletePhoto(Request $request)
{
    $user = Auth::user();

    if ($user->image) {
        // Delete the image from the storage
        Storage::disk('public')->delete($user->image);

        // Set the user's image to null or a default image path
        $user->update(['image' =>'/users/default.jpeg']); // Or you could set a default placeholder image path here
        return response()->json([
            'status' => 'success',
            'message' => 'Profile image deleted successfully.',
            'profile_image_url' =>'/storage/users/default.jpeg' // Path to a default placeholder image
        ]);
    }

    return response()->json([
        'status' => 'error',
        'message' => 'No profile image found.'
    ], 404);
}
public function saveProfileInfo(Request $request){
$user=Auth::user();
$user->update([
    'name'=>$request->name,
    'full_name'=>$request->full_name,
    'email'=>$request->email,
]);
return back()->with('message','Profile Updated Successfully');
}
public function updatePassword(Request $request){
    // dd($request);
    $user = Auth::user();
    $validator= Validator::make($request->all(), [
        'password' => 'required',
        'new_password' => 'required|confirmed',
    ]);
    if ($validator->fails()) {
        return response()->json([
            'status' => 'error',
            'message' => 'Validation failed. ' . $validator->errors()->first()
        ], 400);
    }


    // Check if the current password matches
    if (!Hash::check($request->password, $user->password)) {
        return response()->json([
            'status' => 'error',
            'message' => 'Current password does not match.'
        ], 400);
    }

    // Update the password
    $user->password = Hash::make($request->new_password);
    $user->save();
    return back()->with('message','Password Updated Successfully');
}
public function showUserItems($id){
    $sales=count(Cart::get());
    $products=count(Product::get());
    $users=count(User::get());
    $cartsUsersItems=Cart::where('user_id',$id)->get();
    return view('dashboard.userItems',compact('cartsUsersItems'));
}
}
