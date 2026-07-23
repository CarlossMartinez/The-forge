<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;// Para el login con GitHub
use App\Models\User;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/auth/github/redirect', function () {
    return Socialite::driver('github')->redirect();
});

Route::get('/auth/github/callback', function () {
    $githubUser = Socialite::driver('github')->stateless()->user();

    //Busco por github_id
    $user = User::where('github_id', $githubUser->id)->first();

    // Si no existe, busco por email
    if (!$user && $githubUser->email) {
        $user = User::where('email', $githubUser->email)->first();
    }

    // Si existe, lo actualizo
    if ($user) {
        $user->update([
            'github_id' => $githubUser->id,
            'username'  => $githubUser->nickname ?? $githubUser->name ?? 'user_' . $githubUser->id,
            'email'     => $githubUser->email,
            'image'     => $githubUser->avatar,
        ]);
    } else {
        //Si no existe lo  creo
        $user = User::create([
            'github_id' => $githubUser->id,
            'username'  => $githubUser->nickname ?? $githubUser->name ?? 'user_' . $githubUser->id,
            'email'     => $githubUser->email,
            'image'     => $githubUser->avatar,
            'role_id'   => 3,
        ]);
    }

    // Crear token Sanctum
    $token = $user->createToken('auth')->plainTextToken;

    // Redirigir al frontend con el token
    return redirect("http://localhost:5173/login-success?token=$token"); //Aquí tengo que cambiar el URL
});


require __DIR__.'/auth.php';
