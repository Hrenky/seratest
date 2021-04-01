<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Http\Request;

class AccountController extends BaseController
{
    /**
     * @OA\Post (
     *     path="/register",
     *     summary="Register a new user",
     *     @OA\RequestBody (
     *          required=true,
     *          description="Deliver user information",
     *          @OA\JsonContent (
     *              required={"username", "password"},
     *              @OA\Property(property="username", type="string", example="Test"),
     *              @OA\Property(property="password", type="string", format="password", example="PassWord12345")
     *          )
     *     ),
     *     @OA\Response (
     *          response=422,
     *          description="Missing credentials",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Missing username/password")
     *              )
     *          )
     *     )
     * )
     */
    public function register(Request $request){
        $this->validate($request, [
            'username' => ['required', 'unique:users,username', 'max:100'],
            'password' => ['required', 'max:100'],
        ]);

        $content = $request->all();

        $user = new Users();
        $user->fill($content);
        $user->password = password_hash($content['password'], PASSWORD_BCRYPT);

        $user->save();

        return response(json_encode($user));
    }

    public function profile() {
        return response(json_encode(['user' => auth()->user()]));
    }

    public function edit(Request $request){
        if ($request->password !== '' && !password_verify($request->password, $this->user->password)) {
            $this->user->password = password_hash($request->password, PASSWORD_BCRYPT);
        }

        $this->user->save();

        return response('User info has changed.');
    }

    public function resetPassword(){

    }

    public function delete(Request $request){
        $user = Users::where('userID', '=', $request->userID)
                ->firstOrFail();

        $user->deleted = 1;
        $user->save();

        return response('User deleted.');
    }
}
