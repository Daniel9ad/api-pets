<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $user = Usuario::where('email', $request->email)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Credenciales válidas',
                'user' => $user,
            ], 200);
        }
        return response()->json([
            'message' => 'Credenciales inválidas',
        ], 401);
    }
}
