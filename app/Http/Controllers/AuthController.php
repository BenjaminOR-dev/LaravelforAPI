<?php

namespace App\Http\Controllers;

use App\Models\Usuarios;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth as RulesRequest;
use Illuminate\Validation\ValidationException;

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
    public function login(RulesRequest\Login $request)
    {
        $user = Usuarios::query()
            ->where('email', $request->email)
            ->first();

        if (!$user) {
            throw ValidationException::withMessages([
                'email' => [
                    'No se encontro algún usuario con el correo proporcionado.'
                ]
            ]);
        }

        if (!password_verify($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'password' => [
                    'La contraseña es incorrecta.'
                ]
            ]);
        }

        $this->rememberMe = $request->input('rememberMe') ? $request->rememberMe : false;
        $token = Auth::login($user, $this->rememberMe);

        return $this->respondWithToken($token);
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        $userId = auth()->id();
        $user = Usuarios::query()
            ->where('id', $userId)
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
        return ResponseHelper::json(null);
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
            'token_type'   => 'bearer',
            'expires_in'   => $expiresIn
        ]);
    }
}
