<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function redirectToGithub()
    {
        return response()->json([
        'url' => \Laravel\Socialite\Facades\Socialite::driver('github')
                    ->stateless()
                    ->with(['allow_signup' => 'true'])
                    ->redirect()
                    ->getTargetUrl() . '&login=true'
    ]);
    }

    public function handleGithubCallback()
    {
        try {
            $githubUser = \Laravel\Socialite\Facades\Socialite::driver('github')
                            ->stateless()
                            ->user();

            $user = \App\Models\User::updateOrCreate(
                ['github_id' => $githubUser->getId()],
                [
                    'username' => $githubUser->getNickname() ?? $githubUser->getName(),
                    'email'    => $githubUser->getEmail(),
                    'image'    => $githubUser->getAvatar(),
                    'role_id'  => 1,
                ]
            );

            $token = $user->createToken('auth_token')->plainTextToken;

            return redirect(env('FRONTEND_URL') . '/auth/callback?token=' . $token);

        } catch (\Exception $e) {
            return redirect(env('FRONTEND_URL') . '/login?error=true');
        }
    }

    public function logout(Request $request)
    {
        // Elimina solo el token actual
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Sessió tancada correctament'
        ]);
    }

    public function me(Request $request)
    {
        return response()->json($request->user());
    }
}