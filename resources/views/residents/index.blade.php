@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 font-weight-bold">Master Data - Data Penduduk</h5>
            <a href="{{ route('residents.create') }}" class="btn btn-light btn-sm font-weight-bold">+ Tambah Penduduk</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>No. KK</th>
                            <th>NIK</th>
                            <th>Nama Lengkap</th>
                            <th>L/P</th>
                            <th>Pekerjaan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($residents as $index => $resident)
                        <tr>
                            <td>{{ $residents->firstItem() + $index }}</td>
                            <td>{{ $resident->no_kk }}</td>
                            <td>{{ $resident->nik }}</td>
                            <td>{{ $resident->name }}</td>
                            <td>{{ $resident->gender == 'L' ? 'Laki-laki' : 'Perempuan' }}</td>
                            <td>{{ $resident->profession }}</td>
                            <td>
                                <a href="#" class="btn btn-warning btn-sm text-white">Edit</a>
                                <button class="btn btn-danger btn-sm">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada data kependudukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $residents->links() }}
            </div>
        </div>
    </div>
</div>
@endsection