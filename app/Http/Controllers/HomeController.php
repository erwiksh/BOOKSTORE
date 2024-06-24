<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\buku;
use App\Models\penerbit;

class HomeController extends Controller
{
    public function buku()
    {
        $buku = buku::paginate(20);;
        return view('index', ['buku' => $buku]);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $buku = Buku::where('nama', 'like', '%' . $query . '%')->paginate(20);

        return view('index', compact('buku'));
    }

    public function buy(Request $request, buku $b)
    {
        //Validasi stok 
        if ($b->stok > 0) {
            //buku berkurang
            $b->stok--;
            $b->save();

            //Redirect ke halaman sebelumnya
            return back()->with('success','Buku Telah Berhasil Dibeli');
        }else {
            //Redirect dengan pesan jika stok habis
            return back()->with('error', 'Maaf, stok buku telah habis');
        }
    }
}
