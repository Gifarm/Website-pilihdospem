<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        // Ambil enum dari database
        $type = DB::select("SHOW COLUMNS FROM users WHERE Field = 'role'")[0]->Type;

        preg_match('/enum\((.*)\)/', $type, $matches);

        $roles = array_map(function ($value) {
            return trim($value, "'");
        }, explode(',', $matches[1]));

        return view('auth.register', compact('roles'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Ambil enum lagi untuk validasi dinamis
        $type = DB::select("SHOW COLUMNS FROM users WHERE Field = 'role'")[0]->Type;

        preg_match('/enum\((.*)\)/', $type, $matches);

        $roles = array_map(function ($value) {
            return trim($value, "'");
        }, explode(',', $matches[1]));

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'in:' . implode(',', $roles)],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // ⚠️ Optional keamanan (disarankan)
        // cegah user daftar jadi superadmin
        // if ($request->role === 'superadmin') {
        //     abort(403);
        // }

        $user = User::create([
            'name' => $request->name,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
