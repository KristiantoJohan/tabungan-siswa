<?php

namespace App\Http\Controllers;

use App\Models\Classes;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSiswaSectionController extends Controller
{
    public function showAdminSiswaSection() {
        $classes = Classes::all();
        $students = Students::with(['class', 'user'])->get();

        return view('admin.siswa', compact('classes', 'students'));
    }

    public function store(Request $request) {
        $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'name'     => 'required|string|max:255',
            'rfid'     => 'required|string',
            'address'  => 'required|string',
            'class_id' => 'required|uuid|exists:classes,id',
            'telephone'=> 'required|string',
        ]);
    
        DB::beginTransaction();

        try {
            // Simpan ke table users
            $user = User::create([
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role'     => 'STUDENT',
            ]);
    
            // Simpan ke table students
            Students::create([
                'user_id'   => $user->id,
                'name'      => $request->name,
                'rfid'      => $request->rfid,
                'address'   => $request->address,
                'class_id'  => $request->class_id,
                'telephone' => $request->telephone,
            ]);
    
            DB::commit();
    
            return redirect()->back()->with('success', 'Siswa berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Gagal menambahkan siswa: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete(); // student akan otomatis ikut terhapus

        return redirect()->back()->with('success', 'Akun user dan data siswa berhasil dihapus.');
    }

    public function update(Request $request, $id)
    {
        $student = Students::findOrFail($id);
        $student->update($request->only(['name', 'rfid', 'address', 'class_id', 'telephone']));
        
        return redirect()->back()->with('success', 'Data siswa berhasil diperbarui.');
    }

}
