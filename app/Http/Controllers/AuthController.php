<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use Illuminate\Http\Request;
use App\Enums\HttpStatusEnum;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    /**
     * Remember me var
     *
     * @var bool
     */
    private $rememberMe = false;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'       => ['required', 'string', 'email', 'exists:usuarios,email'],
            'password'    => ['required', 'string'],
            'rememberMe'  => ['nullable', 'boolean']
        ]);

        if ($request->input('rememberMe') == true) {
            $this->rememberMe = true;
        }

        if (!$token = auth()->attempt($request->only(['email', 'password']))) {
            abort(HttpStatusEnum::UNPROCESSABLE_ENTITY, "Las licencias son incorrectas");
        }

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $user = auth()->user();
        $user = Usuarios::query()
            ->where('id', $user->id)
            ->with([
                'perfil',
                'empresa',
            ])
            ->first();

        return response()->json($user);
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return ResponseHelper::json(null, 'Sesión cerrada correctamente');
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function respondWithToken($token)
    {
        $expiresIn = auth()->factory()->getTTL() * 60;
        if ($this->rememberMe == true) {
            $expiresIn = auth()->factory()->getTTL() * 9999999;
        }

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiresIn
        ]);
    }
}
