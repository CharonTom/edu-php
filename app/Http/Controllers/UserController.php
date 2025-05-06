<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class UserController extends Controller
{
    /**
     * Génère un QR code pointant vers la route de sign-in.
     */
    public function generateQrCode(Request $request)
    {
        // 1. Récupère l'élève connecté
        $userId = $request->user()->id;
    
        // 2. Construit l'URL de sign-in en incorporant l'ID
        $url = route('user.signIn', ['id' => $userId]);
    
        // 3. Génère le SVG du QR
        $svg = QrCode::size(200)->generate($url);
    
        return response($svg)
               ->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Marque l’utilisateur comme présent et renvoie un JSON.
     */
    public function signIn($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->signed_in = true;
            $user->save();

            return response()->json([
                'message' => 'User signed in successfully'
            ]);
        }

        return response()->json([
            'message' => 'User not found'
        ], 404);
    }
}
