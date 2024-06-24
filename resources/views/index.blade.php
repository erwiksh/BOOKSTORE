@extends('layout.app')

@section('nama halaman')
<h1 style="color:blck; font-weight:bold;">Selamat Datang Di</h1>
<h1 style="color: linear-gradient(135deg, #C76CD7 0%, #3324AFAD 100%);">UNIBOOKSTORE</h1>
@endsection

@section('cari')
    <!-- Form pencarian -->
    <form class="form-inline" role="search" method="GET" action="{{ route('search') }}">
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
            <!-- Dropdown info jumlah data -->
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: linear-gradient(135deg, #C76CD7 0%, #3324AFAD 100%);">
                    Info Jumlah Data
                </button>
                <br>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <!-- Informasi jumlah data buku -->
                    <a class="dropdown-item" href="#">
                        Halaman Ke: {{ $buku->currentPage() }} <br />
                        Jumlah Data: {{ $buku->total() }} <br />
                        Data Per Halaman: {{ $buku->perPage() }} <br />
                    </a>
                </div>
            </div>
            <br>

            <!-- Alert jika ada pesan sukses -->
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif

            <!-- Daftar buku -->
            <div class="card">
                    <table class="table table-striped">
                        <thead>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Stok</th>
                            <th>Penerbit</th>
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
                                    <td>{{$b->nama}}</td>
                                    <td>{{$b->kategori}}</td>
                                    <!-- Format harga dalam mata uang Rupiah -->
                                    <td>Rp{{ number_format($b->harga, 0, ',', '.') }}</td>
                                    <td>{{$b->stok}}</td>
                                    <td>{{ $b->penerbit->nama }}</td>
                                    <td>
                                        <!-- Form untuk membeli buku -->
                                        @if ($b->stok > 0)
                                            <form action="{{ route('buku.buy', ['b' => $b->id]) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('Buku akan di beli')">Beli</button>
                                            </form>
                                        @else
                                            <p class="text-danger">Buku telah habis</p>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
            </div>
            
            <!-- Pagination -->
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
    </div>
@endsection
