<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{

    public function index()
    {
        $data = Peminjaman::with('user','buku')->get();
        return view('peminjaman.index', compact('data'));
    }


    public function create()
    {
        $buku = Buku::all();
        // $user = User::all();
        return view('peminjaman.form_create', compact('buku'));
    }


    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'buku_id' => 'required',
            'tanggal_peminjaman' => 'required',
            'tanggal_pengembalian' => 'required',
            'status_peminjaman' => 'required',

        ],[
            'buku_id.required' => 'buku wajib diisi',
            'tanggal_peminjaman.required' => 'tanggal peminjaman wajib diisi',
            'tanggal_pengembalian.required' => 'tanggal pengembalian wajib diisi',
            'status_peminjaman.required' => 'status peminjaman wajib diisi',
        ]);

        $user = Auth::user()->id;
        $data = [
            'buku_id' => $request->buku_id,
            'user_id' => $user,
            'tanggal_peminjaman' => $request->tanggal_peminjaman,
            'tanggal_pengembalian' => $request->tanggal_pengembalian,
            'status_peminjaman' => $request->status_peminjaman,
        ];
        Peminjaman::create($data);
        return redirect()->route('peminjaman.index')->with('success','Data Berhasil Disimpan');
    }



    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
