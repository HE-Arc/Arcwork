<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'pseudo' => 'required|unique:users|max:20',
            'password' => 'required',
            'color' => 'required|max:7',
            'bio' => 'required',
            'profilePicPath' => 'required'
        ]);

        $statusMsg = "success";
        $token = Str::random(20);

        $user = User::create([
            "pseudo" => $validated['pseudo'],
            "password" => Hash::make($validated['password']),
            "color" => $validated['color'],
            "like" => 0,
            "bio" => $validated['bio'],
            "profilePicPath" => $validated['profilePicPath'],
            "identificationToken" => $token
        ]);

        return response()->json([
            "status" => $statusMsg,
            "identificationToken" => $token,
            'id' => $user['id']
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function destroy($id)
    {
    }


    public static function like($id)
    {
        $msg = "fail";
        if (is_int((int)$id)) {
            $user = User::findOrFail($id);
            $user['like'] = $user['like'] + 1;
            $user->update();
            $msg = "success";
        }
        return response()->json(["status" => $msg]);
    }

    public function login(Request $request)
    {

        $validated = $request->validate([
            'pseudo' => 'required',
            'password' => 'required'
        ]);

        $status = 'fail';
        $token = '';

        $user = User::where('pseudo', $validated['pseudo'])->get()->first();
        if (!empty($user)) {
            if (Hash::check($validated["password"], $user["password"])) {
                $status = 'success';
                $token = $user['identificationToken'];
            } else {
                $status = "wrong password";
            }
        }

        return response()->json([
            "status" => $status,
            'token' => $token,
        ]);
    }
}
