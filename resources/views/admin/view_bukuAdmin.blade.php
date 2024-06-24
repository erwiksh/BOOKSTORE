@extends('layout.app')

@section('nama halaman')
Buku
@endsection

@section('cari')
    <!-- Form pencarian -->
    <form class="form-inline" role="search" method="GET" action="{{ route('searchAdmin') }}">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" name="query" type="search" placeholder="Cari buku..." aria-label="Search">
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
        <button type="button" class="mb-2 btn btn-primary" data-toggle="modal" data-target="#modalBukuTambah">Tambah Data Buku</button>
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: linear-gradient(135deg, #C76CD7 0%, #3324AFAD 100%);">
                Info Jumlah Data
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">
                    Halaman Ke: {{ $buku->currentPage() }} <br />
                    Jumlah Data: {{ $buku->total() }} <br />
                    Data Per Halaman: {{ $buku->perPage() }} <br />
                </a>
            </div>
        </div>
        <br>
        @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li> <strong>Whoops! {{ $error }}</strong></li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card">
            <p>
                <table class="table table-striped">
                    <thead>
                        <th>ID Buku</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penerbit</th>
                        <th>Harga</th>
                        <th>Stok</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @if ($buku->isEmpty())
                        <tbody>
                            <tr>
                                <td colspan="7">Tidak ada data</td>
                            </tr>
                        </tbody>
                        @else
                        @foreach ($buku as $b)
                            <tr>
                                <td>{{$b->id_buku}}</td>
                                <td>{{$b->nama}}</td>
                                <td>{{$b->kategori}}</td>
                                <td>{{$b->penerbit->nama }}</td>
                                <td>Rp{{ number_format($b->harga, 0, ',', '.') }}</td>
                                <td>{{$b->stok}}</td>
                                <td>
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-warning mr-2" data-toggle="modal" data-target="#modalBukuEdit{{$b->id}}">Edit</button>
                                         <!-- Awal Modal EDIT data Buku -->
                                         <div class="modal fade" id="modalBukuEdit{{$b->id}}" tabindex="-1" role="dialog" aria-labelledby="modalBukuEditLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="modalBukuEditLabel">Form Edit Data Buku</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form name="formBukuEdit" id="formBukuEdit{{$b->id}}" action="{{ route('buku.edit', $b->id) }}" method="post" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="form-group row">
                                                                <label for="id_buku" class="col-sm-4 col-form-label">ID Buku</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" id="id_buku{{$b->id}}" name="id_buku" value="{{ $b->id_buku}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="nama" class="col-sm-4 col-form-label">Nama Buku</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" id="nama{{$b->id}}" name="nama" value="{{ $b->nama}}">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="penerbit_id" class="col-sm-4 col-form-label">Nama Penerbit</label>
                                                                <div class="col-sm-8">
                                                                    <select id="penerbit_id{{$b->id}}" class="form-control" name="penerbit">
                                                                        <option value="{{ $b->penerbit_id }}">{{ $b->penerbit->nama }}</option>
                                                                        @foreach ($penerbit as $p)
                                                                            <option value="{{ $p->id }}">{{ $p->nama }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" id="kategori{{$b->id}}" name="kategori" value="{{ $b->kategori}}">
                                                                </div>
                                                            </div>
                                                          
                                                            <div class="form-group row">
                                                                <label for="harga" class="col-sm-4 col-form-label">Harga</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" id="harga{{$b->id}}" name="harga" value="{{ $b->harga}}">
                                                                    <small class="warning" style="color: red;">Mohon Masukkan Data Tanpa Tanda Titik(.) ataupun koma(,)<br>Contoh: 5000 </small>
                                                                </div>
                                                            </div>
                        
                                                            
                                                            <div class="form-group row">
                                                                <label for="stok" class="col-sm-4 col-form-label">Stok</label>
                                                                <div class="col-sm-8">
                                                                    <input type="text" class="form-control" id="stok{{$b->id}}" name="stok" value="{{ $b->stok}}">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                                                <button type="submit" class="btn btn-success" name="bukutambah">Edit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Akhir Modal EDIT data buku -->
                                        <form action="{{route('admin.destroy', $b->id)}}" method="POST" onclick="return confirm('Yakin mau dihapus?')">
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
                <!-- Awal Modal tambah data Buku -->
                <div class="modal fade" id="modalBukuTambah" tabindex="-1" role="dialog" aria-labelledby="modalBukuTambahLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalBukuTambahLabel">Form Input Data Buku</h5>
                            </div>
                            <div class="modal-body">
                                <form name="formbukutambah" id="formbukutambah"  action="{{ route('buku.tambah') }}" method="POST">
                                    @csrf    
                                    <div class="form-group row">
                                        <label for="id_buku" class="col-sm-4 col-form-label">ID Buku</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="id_buku" name="id_buku" placeholder="Masukan ID Buku" required>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-4 col-form-label">Judul Buku</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Judul Buku" required>
                                        </div>
                                    </div>
        
                                    <div class="form-group row">
                                        <label for="penerbit" class="col-sm-4 col-form-label">Nama Penerbit</label>
                                        <div class="col-sm-8">
                                            <select class="form-control" id="penerbit" name="penerbit" required>
                                                @foreach ($penerbit as $p)
                                                    <option value={{ $p->id }}>{{ $p->nama }}</option>
                                                @endforeach
                                            </select>
                                            <small>Penerbit Belum Ada? <a href="{{ route('penerbit.admin') }}">clik di sini</a></small>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group row">
                                        <label for="kategori" class="col-sm-4 col-form-label">Kategori</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Masukan Kategori" required>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="harga" class="col-sm-4 col-form-label">Harga</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="harga" name="harga" placeholder="Masukan Harga" required>
                                            <small class="warning" style="color: red;">Mohon Masukkan Data Tanpa Tanda Titik(.) ataupun koma(,)<br>Contoh: 5000 </small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="stok" class="col-sm-4 col-form-label">Stok</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="stok" name="stok" placeholder="Masukan Stok" required>
                                        </div>
                                    </div>
        
                                    <div class="modal-footer">
                                        <button type="button" name="tutup" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                                        <button type="submit" class="btn btn-success">Tambah</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Akhir Modal tambah data Buku -->
            </p>
        </div>
    </div>
    <!--awal pagination-->
    <div class="pagination justify-content-center">
        <ul class="pagination">
            <!-- Tombol Previous -->
            @if ($buku->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
            @else
                <li class="page-item"><a class="page-link" href="{{ $buku->previousPageUrl() }}">&laquo;</a></li>
            @endif

            <!-- Tombol Nomor Halaman -->
            @foreach ($buku->getUrlRange(1, $buku->lastPage()) as $page => $url)
                @if ($page == $buku->currentPage())
                    <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                    <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
            @endforeach

            <!-- Tombol Next -->
            @if ($buku->hasMorePages())
                <li class="page-item"><a class="page-link" href="{{ $buku->nextPageUrl() }}">&raquo;</a></li>
            @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
            @endif
        </ul>
    </div>
    <!--akhir pagination-->
</div>
@endsection
