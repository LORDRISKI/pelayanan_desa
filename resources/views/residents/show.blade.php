@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="card border-0 shadow-sm p-4 bg-white" style="max-width: 700px;">
        
        <div class="d-flex justify-content-between align-items-center mb-4面 border-bottom pb-3">
            <h5 class="fw-bold text-dark mb-0">Detail Biodata Penduduk</h5>
            <a href="{{ route('residents.index') }}" class="btn btn-secondary btn-sm px-3">
                <i class="fa-solid fa-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <tbody>
                    <tr>
                        <th width="200" class="table-light text-muted small fw-bold">Nomor Kartu Keluarga (KK)</th>
                        <td class="text-dark small">{{ $resident->kk_number ?? '-' }}</td>
                    </tr>
                    <tr>
                        <th class="table-light text-muted small fw-bold">NIK</th>
                        <td class="text-dark small fw-bold text-primary">{{ $resident->nik }}</td>
                    </tr>
                    <tr>
                        <th class="table-light text-muted small fw-bold">Nama Lengkap</th>
                        <td class="text-dark small fw-semibold">{{ $resident->name }}</td>
                    </tr>
                    <tr>
                        <th class="table-light text-muted small fw-bold">Jenis Kelamin</th>
                        <td class="text-dark small">
                            @if($resident->gender == 'Laki-laki')
                                <span class="badge bg-primary px-3 py-1.5 rounded-pill fw-normal">Laki-laki</span>
                            @else
                                <span class="badge bg-success px-3 py-1.5 rounded-pill fw-normal">Perempuan</span>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th class="table-light text-muted small fw-bold">Tanggal Lahir</th>
                        <td class="text-dark small">
                            {{ $resident->birth_date ? \Carbon\Carbon::parse($resident->birth_date)->format('d F Y') : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="table-light text-muted small fw-bold">Umur</th>
                        <td class="text-dark small">
                            {{ $resident->birth_date ? \Carbon\Carbon::parse($resident->birth_date)->age . ' Tahun' : '-' }}
                        </td>
                    </tr>
                    <tr>
                        <th class="table-light text-muted small fw-bold">Status Perkawinan</th>
                        <td class="text-dark small">{{ str_replace('_', ' ', $resident->marital_status ?? '-') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-warning btn-sm text-white px-3">
                <i class="fa-solid fa-pen-to-square me-1"></i> Ubah Data
            </a>
        </div>

    </div>
</div>
@endsection