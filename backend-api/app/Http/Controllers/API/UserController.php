<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function index()
    {
        $user = User::find(1);
        return response()->json([
            'status'=> 200,
            'posts'=>$user,
        ]);
    }
    // public function update(Request $request,User $user)
    // {
    //     $userId = 1; 
    
    //     $user = User::find($userId);
    
    //     if ($user) {
            
    //         $user->name = $request->input('new-password');
    //         $user->email = "admin@gmail.com";
    //         $user->password = bcrypt($request->input('new-password'));
    //         $user->save();
    
    //         return response()->json([
    //             'status' => 200,
    //             'message' => 'Password Updated Successfully',
    //         ]);
    //     } else {
    //         return response()->json([
    //             'status' => 404,
    //             'message' => 'No User Found with the provided ID',
    //         ]);
    //     }
    // }
    
}
