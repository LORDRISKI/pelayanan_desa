@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="font-weight-bold text-dark mb-0">Struktur Organisasi & Perangkat Desa</h4>
        <!-- Tombol Tambah Perangkat -->
        <button type="button" class="btn btn-primary font-weight-bold shadow-sm" data-bs-toggle="modal" data-bs-target="#addStaffModal">
            + Tambah Perangkat Desa
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show border-0 shadow-sm" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
    @endif

    <!-- BAGAN STRUKTUR VISUAL (Hierarki Dasar) -->
    <div class="row justify-content-center text-center mb-5">
        @php 
            $kades = $staffs->where('sort_order', 1)->first();
            $sekdes = $staffs->where('sort_order', 2)->first();
            $staffLain = $staffs->where('sort_order', '>', 2);
        @endphp

        <!-- Tingkat 1: Kepala Desa -->
        @if($kades)
        <div class="col-md-4 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-header bg-primary text-white py-2 fw-bold">KEPALA DESA</div>
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark mb-1">{{ $kades->name }}</h5>
                    <p class="card-text text-muted small mb-0">NIP: {{ $kades->nip ?? '-' }}</p>
                    <span class="badge bg-light text-primary border border-primary mt-2">{{ $kades->phone }}</span>
                </div>
            </div>
        </div>
        <div class="w-100"></div> <!-- Line break untuk baris baru -->
        @endif

        <!-- Tingkat 2: Sekretaris Desa -->
        @if($sekdes)
        <div class="col-md-4 mb-4">
            <div class="card border-success shadow-sm">
                <div class="card-header bg-success text-white py-2 fw-bold">SEKRETARIS DESA</div>
                <div class="card-body">
                    <h5 class="card-title fw-bold text-dark mb-1">{{ $sekdes->name }}</h5>
                    <p class="card-text text-muted small mb-0">NIP: {{ $sekdes->nip ?? '-' }}</p>
                    <span class="badge bg-light text-success border border-success mt-2">{{ $sekdes->phone }}</span>
                </div>
            </div>
        </div>
        <div class="w-100"></div>
        @endif
    </div>

    <!-- Daftar Semua Anggota/Kasi/Kaur -->
    <h5 class="font-weight-bold text-secondary mb-3">Daftar Jajaran Kasi, Kaur & Pelaksana</h5>
    <div class="row">
        @forelse($staffLain as $staff)
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm text-center">
                <div class="card-body pt-4">
                    <span class="badge bg-secondary mb-2 px-3 py-1">{{ $staff->role }}</span>
                    <h6 class="font-weight-bold text-dark mb-1">{{ $staff->name }}</h6>
                    <p class="text-muted text-truncate px-2 small mb-2">NIP: {{ $staff->nip ?? '-' }}</p>
                    <small class="text-primary fw-bold d-block mb-2">{{ $staff->phone }}</small>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center text-muted py-3">
            Belum ada jajaran staf/kasi yang ditambahkan.
        </div>
        @endforelse
    </div>
</div>

<!-- Modal Tambah Perangkat Desa -->
<div class="modal fade" id="addStaffModal" tabindex="-1" aria-labelledby="addStaffModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <div class="modal-header bg-dark text-white">
                <h5 class="modal-title font-weight-bold" id="addStaffModalLabel">Tambah Perangkat Desa</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staffs.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nama Lengkap</label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Budi Santoso, S.Sos" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Jabatan</label>
                        <input type="text" name="role" class="form-control" placeholder="Contoh: Kasi Pemerintahan / Kaur Keuangan" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">NIP (Opsional)</label>
                        <input type="text" name="nip" class="form-control" placeholder="Isi jika PNS">
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">No. HP / WhatsApp</label>
                            <input type="text" name="phone" class="form-control" placeholder="0812xxxx" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email (Opsional)</label>
                            <input type="email" name="email" class="form-control" placeholder="staf@desa.id">
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Tingkatan Urutan Jabatan (Hierarki)</label>
                        <select name="sort_order" class="form-select" required>
                            <option value="1">Urutan 1 - Kepala Desa</option>
                            <option value="2">Urutan 2 - Sekretaris Desa</option>
                            <option value="3">Urutan 3 - Jajaran Kasi / Kaur / Kepala Dusun</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Simpan Struktur</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection