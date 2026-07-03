<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::where('role_id', 2)->latest()->paginate(10);

        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->role_id !== 2) {
            return back()->with('error', 'Tidak dapat menghapus akun admin.');
        }

        if ($user->enrollments()->exists()) {
            return back()->with('error', 'Peserta masih memiliki enrollment aktif.');
        }

        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('success', 'Peserta berhasil dihapus.');
    }
}
