<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mahasiswa;
use Illuminate\Support\Facades\Redis;

class MahasiswaController extends Controller
{
    public function index()
    {
        $mahasiswa = Mahasiswa::all();
        return view('index', ['mahasiswa' => $mahasiswa]);
    }
    public function tambah()
    {
        //memanggil view tambah
        return view('tambah');
    }

    public function simpan(Request $request)
    {
        //insert data ke table mahasiswa
        Mahasiswa::create([
            'nama' => $request->namamhs,
            'nim' => $request->nimmhs,
            'email' => $request->emailmhs,
            'jurusan' => $request->jurusanmhs
        ]);
        return redirect('/');
    }

    public function detail($id)
    {
        //mengambil data mahasiswa berdasarkan id yang dipilih
        $mahasiswa = Mahasiswa::find($id);
        //kirim data mahasiswa yang di ambil ke view <edit class="blade php">
        return view('detail', ['mahasiswa' => $mahasiswa]);
    }
    public function edit($id)
    {
        //mengambil data mahasiswa berdasarkan id yang dipilih
        $mahasiswa = Mahasiswa::find($id);
        //kirim data mahasiswa yang diambil ke view edit.blade.php
        return view('edit', ['mahasiswa' => $mahasiswa]);
    }

    public function update($id, Request $request)
    {
        //update data mahasiswa
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->nama = $request->namamhs;
        $mahasiswa->nim = $request->nimmhs;
        $mahasiswa->email = $request->emailmhs;
        $mahasiswa->jurusan = $request->jurusanmhs;
        $mahasiswa->save();
        return redirect('/');
    }

    public function hapus($id)
    {
        //menghapus  data mahasiswa berdasarkan id yang dipilih
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();

        return redirect('/');
    }
}
