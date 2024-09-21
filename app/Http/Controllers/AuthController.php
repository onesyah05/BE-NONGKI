<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Exception;

class AuthController extends Controller
{
    public function signup(Request $request) {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ]);

            $user = User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'password' => Hash::make($validatedData['password']),
            ]);

            // Membuat profil kosong untuk user baru
            $user->profile()->create([]);

            DB::commit();
            return $this->succesResponse('User berhasil terdaftar', $request->all(), 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->failedResponse('Gagal mendaftarkan user: ' . $e->getMessage(), null, 500);
        }
    }

    public function login(Request $request) {
        try {
            $credentials = $request->only(['email', 'password']);

            if (!$token = JWTAuth::attempt($credentials)) {
                return $this->failedResponse('Unauthorized', null, 401);
            }

            $userId = auth()->user()->id;
            Cache::put('jwt_token_' . $userId, $token, 3600);

            return $this->succesResponse('Login berhasil', ['user' => auth()->user(), 'token' => $token], 200);
        } catch (Exception $e) {
            return $this->failedResponse('Gagal login: ' . $e->getMessage(), null, 500);
        }
    }

    public function logout() {
        try {
            $userId = auth()->user()->id;
            Cache::forget('jwt_token_' . $userId);
            auth()->logout();

            return $this->succesResponse('Berhasil logout', null, 200);
        } catch (Exception $e) {
            return $this->failedResponse('Gagal logout: ' . $e->getMessage(), null, 500);
        }
    }
}
