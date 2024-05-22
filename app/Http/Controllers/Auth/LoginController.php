<?php

// app/Http/Controllers/Auth/LoginController.php

namespace App\Http\Controllers\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentification réussie
            $redirectUrl = '/';
            if (Auth::user()->statut === 'admin') {
                // Redirection de l'administrateur vers une page spécifique
                $redirectUrl = route('dashboard');
            } else if (Auth::user()->statut === 'gequipe') {
                // Redirection du gestionnaire d'équipe vers son tableau de bord unique
                $redirectUrl = route('gequipe');
            }

            return response()->json(['success' => true, 'message' => 'Vous êtes connecté!', 'redirect' => $redirectUrl]);
        }

        // Authentification échouée
        return response()->json(['success' => false, 'message' => 'Email ou mot de passe incorrect!']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
