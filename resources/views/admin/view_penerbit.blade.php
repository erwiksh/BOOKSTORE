@extends('layout.app')

@section('nama halaman')
Penerbit
@endsection

@section('cari')
    <!-- Form pencarian -->
    <form class="form-inline" role="search" method="GET" action="{{ route('searchPenerbit') }}">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" name="query" type="search" placeholder="Cari penerbit..." aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>
@endsection

@section('content') 
<div class="container-fluid">
    <div class="col-12">
        <!-- Tombol untuk membuka modal tambah penerbit -->
        <button type="button" class="mb-2 btn btn-primary" data-toggle="modal" data-target="#modalPenerbitTambah">Tambah Data Penerbit</button>
        <br>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: linear-gradient(135deg, #C76CD7 0%, #3324AFAD 100%);">
                Info Jumlah Data
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <!--awal pagination-->
                <a class="dropdown-item" href="#">
                    Halaman Ke: {{ $penerbit->currentPage() }} <br />
                    Jumlah Data: {{ $penerbit->total() }} <br />
                    Data Per Halaman: {{ $penerbit->perPage() }} <br />
                </a>
                <!--akhir pagination-->
            </div>
        </div>
        <br>
    </div>
    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li><strong> Whoops!{{ $error }} </strong></li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="card">
            <table class="table table-striped">
                <thead>
                    <th>ID Penerbit</th>
                    <th>Nama Penerbit</th>
                    <th>Alamat</th>
                    <th>Kota</th>
                    <th>Nomor Telepon</th>
                    <th>Aksi</th>
                </thead>
                <tbody>
                    @if ($penerbit->isEmpty())
                    <tbody> 
                        <tr>
                            <td colspan="6">Tidak Ada Data</td>
                        </tr>
                    </tbody>
                    @else
                    @foreach ($penerbit as $p)
                        <tr>
                            <td>{{$p->id_penerbit}}</td>
                            <td>{{$p->nama}}</td>
                            <td>{{$p->alamat}}</td>
                            <td>{{$p->kota }}</td>
                            <td>{{$p->telepon}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <!-- Awal Modal EDIT data Buku -->
                                    <div class="modal fade" id="modalPenerbitEdit{{$p->id}}" tabindex="-1" role="dialog" aria-labelledby="modalPenerbitEditLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="modalPenerbitEditLabel">Form Edit Data Penerbit</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <form name="formpenerbitedit" id="formpenerbitedit"  action="{{ route('penerbit.edit', $p->id) }}" method="post" enctype="multipart/form-data">
                                                        @csrf
                                                        {{ method_field('PUT') }}
                                                        <div class="form-group row">
                                                            <label for="id_penerbit" class="col-sm-4 col-form-label">id penerbit</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="id_penerbit" name="id_penerbit" value="{{ $p->id_penerbit}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="nama" class="col-sm-4 col-form-label">Nama penerbit</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="nama" name="nama" value="{{ $p->nama}}">
                                                            </div>
                                                        </div>  
                                                        <div class="form-group row">
                                                            <label for="alamat" class="col-sm-4 col-form-label">Alamat Penerbit</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{ $p->alamat}}">
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="kota" class="col-sm-4 col-form-label">Kota</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="kota" name="kota" value="{{ $p->kota}}">
                                                            </div>
                                                        </div>   
                                                        <div class="form-group row">
                                                            <label for="telepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                                            <div class="col-sm-8">
                                                                <input type="text" class="form-control" id="telepon" name="telepon" value="{{ $p->telepon}}">
                                                            </div>
                                                        </div>          
                                                        <div class="modal-footer">
                                                            <a href="/penerbit"><button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button></a>
                                                            <button type="submit" name="penerbittambah" class="btn btn-success">Edit</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Akhir Modal EDIT data buku --> 
                                    <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#modalPenerbitEdit{{$p->id}}">Edit</button>
                                    <form action="{{route('penerbit.destroy', $p->id)}}" method="POST" onclick="return confirm('Yakin mau dihapus?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    @endif
                </tbody>
            </table>
        <!-- Awal Modal tambah data Penerbit -->
        <div class="modal fade" id="modalPenerbitTambah" tabindex="-1" role="dialog" aria-labelledby="modalPenerbitTambahLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalPenerbitTambahLabel">Form Input Data Penerbit</h5>
                    </div>
                    <div class="modal-body">
                        <form name="formPenerbitTambah" id="formPenerbitTambah" action="/penerbittambah" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="id_penerbit" class="col-sm-4 col-form-label">ID Penerbit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="id_penerbit" name="id_penerbit" placeholder="Masukan Id Penerbit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nama" class="col-sm-4 col-form-label">Nama Penerbit</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama Penerbit" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="alamat" class="col-sm-4 col-form-label">Alamat</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Masukan Alamat" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="kota" class="col-sm-4 col-form-label">Kota</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="kota" name="kota" placeholder="Masukan Kota" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="telepon" class="col-sm-4 col-form-label">Nomor Telepon</label>
                                <div class="col-sm-8">
                                    <input type="text" class="form-control" id="telepon" name="telepon" placeholder="Masukan Nomor Telepon" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                <button type="submit" class="btn btn-success">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- Akhir Modal tambah data Penerbit -->
    </div>
    
    <!-- Awal Pagination -->
    <div class="pagination justify-content-center">
        <ul class="pagination">
            <!-- Tombol Previous -->
            @if ($penerbit->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $penerbit->previousPageUrl() }}">&laquo;</a></li>
            @endif

            <!-- Tombol Nomor Halaman -->
            @foreach ($penerbit->getUrlRange(1, $penerbit->lastPage()) as $page => $url)
                @if ($page == $penerbit->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            <!-- Tombol Next -->
            @if ($penerbit->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $penerbit->nextPageUrl() }}">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </div>
    <!-- Akhir Pagination -->
</div>
@endsection