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
    public function generateQrCode()
    {
        // On ne passe plus d’ID, c’est l’utilisateur authentifié
        $url = route('user.signIn');

        $svg = QrCode::size(200)->generate($url);

        return response($svg)
               ->header('Content-Type', 'image/svg+xml');
    }

    /**
     * Marque l’utilisateur comme présent et renvoie un JSON.
     */
    public function signIn(Request $request)
    {
        $user = $request->user();
        $user->signed_in = true;
        $user->save();

        return response()->json([
            'message' => 'Présence enregistrée avec succès'
        ]);
    }
}
