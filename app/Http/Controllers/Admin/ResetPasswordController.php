<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ResetPasswordController extends Controller
{
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'role' => 'required|in:admin,perusahaan,penumpang',
            'password' => 'required|min:6|confirmed',
        ]);

        $table = match ($request->role) {
            'admin' => 'admins',
            'perusahaan' => 'perusahaans',
            'penumpang' => 'users',
        };

        $user = DB::table($table)->where('email', $request->email)->first();

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User tidak ditemukan'], 404);
        }

        DB::table($table)->where('email', $request->email)->update([
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['success' => true, 'message' => 'Password berhasil direset']);
    }
}
