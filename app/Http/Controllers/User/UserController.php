<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $user->name = $request['name'];
        $user->last_name = $request->input('last_name');
        $user->age = $request->input('age');
        $user->address = $request->input('address');
        $user->contact = $request->input('contact');
        $user->bio = $request->input('bio');
        $user->gender = $request->input('gender');
        $user->birthday = $request->input('birthday');
        if ($request->file('image')) {
            $image = $request->file('image');
            $fileName = uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('user-images'), $fileName);
            $user->image = $fileName;
            $user->save();
        }
        $user->save();

        return response()->json('user');
    }
}
