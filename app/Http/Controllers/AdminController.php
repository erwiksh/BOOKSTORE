<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Penerbit;

class AdminController extends Controller
{
    //Halaman Admin
    //Buku
    public function bukuAdmin()
    {
        $buku = Buku::latest()->paginate(20);
        $penerbit = Penerbit::all();
        return view('admin.view_bukuAdmin', compact('buku', 'penerbit'));
    }

    public function searchAdmin(Request $request)
    {
        $query = $request->input('query');
        $buku = Buku::where('nama', 'like', '%' . $query . '%')->paginate(20);
        $penerbit = penerbit::all();

        return view('admin.view_bukuAdmin', compact('buku', 'penerbit'));
    }

    public function create(Request $request)
    {
        $buku = Buku::all();
        $penerbit = Penerbit::all();
        return view('admin.view_bukuAdmin', compact('buku', 'penerbit'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_buku' => 'required|unique:buku|max:255',
            'nama' => 'required',
            'penerbit' => 'required',
            'kategori' => 'required',
            'harga' => 'required|numeric',
            'stok' => 'required|numeric',
        ], [
            'id_buku.unique' => 'ID buku sudah tersedia',
        ]);

        $buku = new Buku;
        $buku->id_buku = $request->id_buku;
        $buku->nama = $request->nama;
        $buku->kategori = $request->kategori;
        $buku->harga = $request->harga;
        $buku->stok = $request->stok;
        $buku->penerbit_id = $request->penerbit;
        $buku->save();

        return redirect()->route('buku.admin')->with('success', 'Data buku berhasil ditambahkan.');
    }

    public function destroy(Buku $buku)
    {
        $buku->delete();

        return redirect()->route('buku.admin')->with('success', 'Berhasil Hapus !');
    }

    public function edit($id)
    {
        $buku = Buku::findOrFail($id);
        $penerbit = Penerbit::all();

        return view('admin.view_bukuAdmin')->with(['buku' => $buku, 'penerbit' => $penerbit]);
    }

    public function update(Request $request, $id)
    {
        $buku = Buku::find($id);
        $buku->update($request->all());

        return redirect()->route('buku.admin')->with('success', 'Berhasil Update !');
    }

    //Penerbit
    public function penerbitAdmin()
    {
        $penerbit = Penerbit::latest()->paginate(20);
        return view('admin.view_penerbit', compact('penerbit'));
    }

    public function searchPenerbit(Request $request)
    {
        $query = $request->input('query');
        $penerbit = Penerbit::where('nama', 'like', '%' . $query . '%')->paginate(20);

        return view('admin.view_penerbit', compact('penerbit'))->with('message', $penerbit->isEmpty() ? 'Tidak ada data yang ditemukan.' : '');
    }

    public function tambah(Request $request)
    {
        $penerbit = Penerbit::all();
        return view('admin.view_penerbit', compact('penerbit'));
    }

    public function tambahsimpan(Request $request)
    {
        $validatedData = $request->validate([
            'id_penerbit' => 'required|unique:penerbit|max:255',
            'nama' => 'required',
            'alamat' => 'required',
            'kota' => 'required',
            'telepon' => 'required',
        ], [
            'id_penerbit.unique' => 'ID penerbit sudah tersedia',
        ]);

        $penerbit = new Penerbit;
        $penerbit->id_penerbit = $request->id_penerbit;
        $penerbit->nama = $request->nama;
        $penerbit->alamat = $request->alamat;
        $penerbit->kota = $request->kota;
        $penerbit->telepon = $request->telepon;
        $penerbit->save();

        return redirect()->route('penerbit.admin')->with('success', 'Data berhasil ditambahkan');
    }

    public function destroypenerbit(Penerbit $penerbit)
    {
        $penerbit->delete();

        return redirect()->route('penerbit.admin')->with('success', 'Berhasil dihapus');
    }

    public function editpenerbit($id)
    {
        $penerbit = Penerbit::findOrFail($id);

        return view('admin.view_penerbitedit')->with(['penerbit' => $penerbit]);
    }

    public function updatepenerbit(Request $request, $id)
    {
        $penerbit = Penerbit::find($id);
        $penerbit->update($request->all());

        return redirect()->route('penerbit.admin')->with('success', 'Berhasil di update');
    }

    //Halaman Pengadaan
    public function pengadaan(Request $request)
    {
        $buku = Buku::orderBy('stok', 'asc')->paginate(20);
        $penerbit = Penerbit::all();
        return view('pengadaan.view_pengadaan', compact('buku', 'penerbit'))->with('success', 'Data berhasil ditambahkan');
    }

    public function searchPengadaan(Request $request)
    {
        $query = $request->input('query');
        $buku = Buku::where('nama', 'like', '%' . $query . '%')->paginate(20);

        return view('pengadaan.view_pengadaan', compact('buku'))->with('message', $buku->isEmpty() ? 'Tidak ada data yang ditemukan.' : '');
    }
}
