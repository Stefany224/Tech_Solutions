<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Exception;

class JwtMiddleware {
    public function handle(Request $request, Closure $next) {
        try {
            // autentica al usuario a partir del token 
            $usuario = JWTAuth::parseToken()->authenticate();
        } catch (TokenExpiredException $e) {
            // en caso de que el token exista pero ya caduco
            return response()->json(['message' => 'Token expirado'], 401);
        } catch (TokenInvalidException $e) {
            // si el token existe pero no es valido
            return response()->json(['message' => 'Token invalido'], 401);
        } catch (Exception $e) {
            // en caso de que no llegue ningun token en la peticion
            return response()->json(['message' => 'Token no proporcionado'], 401);
        }

        return $next($request);
    }
}