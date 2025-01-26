<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|unique:tm_user,user_id|max:10',
            'user_nama' => 'required|max:50',
            'user_pass' => 'required|min:6',
            'user_hak' => 'required|max:2',
            'user_sts' => 'required|max:2',
        ]);

        User::create([
            'user_id' => $request->user_id,
            'user_nama' => $request->user_nama,
            'user_pass' => bcrypt($request->user_pass),
            'user_hak' => $request->user_hak,
            'user_sts' => $request->user_sts,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_nama' => 'required|max:50',
            'user_hak' => 'required|max:2',
            'user_sts' => 'required|max:2',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'user_nama' => $request->user_nama,
            'user_hak' => $request->user_hak,
            'user_sts' => $request->user_sts,
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus');
    }
}
