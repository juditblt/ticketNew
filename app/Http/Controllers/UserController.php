<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserDestroyPostRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users', [
            'users' => User::all()
        ]);
    }

    public function promote(Request $request){
        $user = User::find($request->id);
        $user->role = 'admin';
        $user->save();
        return redirect()->route('admin.users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDestroyPostRequest $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return redirect()->route('admin.users');
    }
}
