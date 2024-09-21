<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;
use Exception;

class ProfileController extends Controller
{
    public function show() {
        try {
            $profile = auth()->user()->profile;
            if (!$profile) {
                return $this->failedResponse('Profil tidak ditemukan', null, 404);
            }
            return $this->succesResponse('', $profile, 200);
        } catch (Exception $e) {
            return $this->failedResponse('Gagal mengambil profil: ' . $e->getMessage(), null, 500);
        }
    }

    public function update(Request $request) {
        DB::beginTransaction();
        try {
            $validatedData = $request->validate([
                'full_name' => 'string|max:255',
                'address' => 'string|max:255',
                'gender' => 'in:Male,Female',
                'marital_status' => 'in:Single,Married',
            ]);

            $profile = auth()->user()->profile;

            if (!$profile) {
                DB::rollBack();
                return $this->failedResponse('Profil tidak ditemukan', null, 404);
            }

            $profile->update($validatedData);

            DB::commit();
            return $this->succesResponse('Profil berhasil diperbarui', $profile, 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->failedResponse('Gagal memperbarui profil: ' . $e->getMessage(), null, 500);
        }
    }

    public function delete() {
        DB::beginTransaction();
        try {
            $profile = auth()->user()->profile;

            if (!$profile) {
                DB::rollBack();
                return $this->failedResponse('Profil tidak ditemukan', null, 404);
            }

            $profile->delete();

            DB::commit();
            return $this->succesResponse('Profil berhasil dihapus', null, 200);
        } catch (Exception $e) {
            DB::rollBack();
            return $this->failedResponse('Gagal menghapus profil: ' . $e->getMessage(), null, 500);
        }
    }
}
