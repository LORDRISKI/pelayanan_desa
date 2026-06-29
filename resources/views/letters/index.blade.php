@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center py-3">
            <h5 class="mb-0 font-weight-bold">Pelayanan - Arsip Surat Keluar</h5>
            <a href="{{ route('letters.create') }}" class="btn btn-primary btn-sm font-weight-bold">+ Buat Surat Baru</a>
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
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>No. Surat</th>
                            <th>Jenis Surat</th>
                            <th>Nama Pemohon (Warga)</th>
                            <th>Tanggal Cetak</th>
                            <th>Keperluan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($letters as $index => $letter)
                        <tr>
                            <td>{{ $letters->firstItem() + $index }}</td>
                            <td class="fw-bold text-secondary">{{ $letter->letter_number }}</td>
                            <td><span class="badge bg-info text-dark fw-bold">{{ $letter->letter_type }}</span></td>
                            <td>{{ $letter->resident->name }}</td>
                            <td>{{ \Carbon\Carbon::parse($letter->letter_date)->translatedFormat('d M Y') }}</td>
                            <td>{{ $letter->purpose }}</td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="window.print()">Cetak / Print</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Belum ada riwayat surat yang dicetak.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $letters->links() }}
            </div>
        </div>
    </div>
</div>
@endsection