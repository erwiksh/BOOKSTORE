@extends('layout.app')

@section('nama halaman')
Pengadaan
@endsection

@section('cari')
    <!-- Form pencarian -->
    <form class="form-inline" role="search" method="GET" action="{{ route('searchPengadaan') }}">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" name="query" type="search" placeholder="Cari buku..." aria-label="Search" value="{{ isset($query) ? $query : '' }}">
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
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background: linear-gradient(135deg, #C76CD7 0%, #3324AFAD 100%);">
                Info Jumlah Data
            </button>
            <br>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#">
                    Halaman: {{ $buku->currentPage() }} <br />
                    Jumlah Data: {{ $buku->total() }} <br />
                    Data Per Halaman: {{ $buku->perPage() }} <br />
                </a>
            </div>
        </div>
        <br>
        <div class="card">
            <table class="table table-striped">
                <thead>
                    <th>Judul</th>
                    <th>Penerbit</th>
                    <th>Stok</th>
                    <th>Telepon</th>
                    <th>Hubungi</th>
                </thead>
                <tbody>
                    @if ($buku->isEmpty())
                    <tbody>
                        <tr>
                            <td colspan="5">Tidak Ada Data</td>
                        </tr>
                    </tbody>
                    @else
                    @foreach ($buku as $b)
                    <tr class="{{ $b->stok == 0 ? 'bg-danger text-dark font-weight-bold' : ($b->stok == 1 ? 'bg-warning font-weight-bold' : '') }}">
                        <td>{{$b->nama}}</td>
                        <td>{{$b->penerbit->nama}}</td>
                        <td>{{$b->stok}}</td>
                        <td>{{$b->penerbit->telepon}}</td>
                        <td>
                            @php
                            $phoneNumber = $b->penerbit->telepon;
                            $phoneNumber = preg_replace('/\D/', '', $phoneNumber);
                            if (substr($phoneNumber, 0, 2) === '08') {
                            $phoneNumber = '+62' . substr($phoneNumber, 1);
                            }
                            @endphp
                            <a href="https://wa.me/{{ $phoneNumber }}" target="_blank" class="btn btn-primary">Hubungi</a>
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
        <!-- Akhir Pagination -->
    </div>
</div>
@endsection
