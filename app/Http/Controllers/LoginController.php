<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * @OA\Post(
     *      path="/api/login",
     *      operationId="login user using email and password",
     *      tags={"Auth"},
     *      summary="login user using email and password",
     *      description="login user using email and password",
     *      security={{ "apiAuth": {} }},
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\MediaType(
     *              mediaType="multipart/form-data",
     *              @OA\Schema(
     *                  required={"email", "password"},
     *                  @OA\Property(property="email", type="text", format="text", example="admin@admin.com"),
     *                  @OA\Property(property="password", type="hidden", format="string", example="123456"),
     *               ),
     *           ),
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="success",
     *       ),
     *     @OA\Response(
     *          response=422,
     *          description="error",
     *       ),
     *     @OA\Response(
     *          response=401,
     *          description="not authenticate",
     *       ),
     * )
     */
    public function login(LoginUser $request)
    {
        $user = User::query()->findByEmail($request->email)->first();
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'مشخصات وارد شده با سیستم مطابقت ندارد.'], 422);
        }

        auth()->login($user);
        return $this->responseWithToken($user);

    }

    private function responseWithToken($user)
    {
        return json_encode([
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'token' => $user->createToken($user->email)->plainTextToken,
        ]);
    }
}
