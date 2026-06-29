@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show small py-2 mb-3 shadow-sm border-0" role="alert">
            <i class="fa-solid fa-circle-check me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close py-2" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card border-0 shadow-sm p-4 bg-white">
        
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold text-dark mb-0">Struktur Organisasi Desa Ramaya</h4>
            
            <button type="button" class="btn btn-primary d-flex align-items-center gap-2 px-3 small shadow-sm" data-bs-toggle="modal" data-bs-target="#uploadStrukturModal">
                <i class="fa-solid fa-database"></i> Kelola Data
            </button>
        </div>

        <div class="p-4 border rounded-3 text-center bg-light" style="border-style: dashed !important; border-width: 2px !important;">
            @if(isset($villageStructure) && $villageStructure->image_path)
                <div class="img-container py-2">
                    <img src="{{ asset('storage/' . $villageStructure->image_path) }}" alt="Bagan Struktur Organisasi Desa" class="img-fluid rounded shadow-sm" style="max-height: 600px; object-fit: contain;">
                </div>
            @else
                <div class="py-5 text-muted">
                    <i class="fa-solid fa-sitemap display-4 mb-3 text-black-50"></i>
                    <p class="mb-0 small fw-semibold">Belum ada gambar struktur organisasi yang diupload.</p>
                    <small>Klik tombol <strong>Kelola Data</strong> di atas untuk mengupload file bagan baru.</small>
                </div>
            @endif
        </div>

    </div>
</div>

<div class="modal fade" id="uploadStrukturModal" tabindex="-1" aria-labelledby="uploadStrukturModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow">
            <form action="{{ route('village.structure.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header bg-light">
                    <h5 class="modal-title fw-bold text-dark small fs-6" id="uploadStrukturModalLabel">Kelola Struktur Organisasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label small fw-bold text-secondary">Upload File Bagan Baru</label>
                        <input type="file" name="structure_image" class="form-control form-control-sm @error('structure_image') is-invalid @enderror" accept="image/*" required>
                        <div class="form-text text-muted" style="font-size: 11px;">
                            Dukung format file: JPG, JPEG, PNG. Maksimal ukuran 2MB.
                        </div>
                        @error('structure_image')
                            <span class="invalid-feedback small" role="alert"><strong>{{ $message }}</strong></span>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer bg-light py-2">
                    <button type="button" class="btn btn-secondary btn-sm px-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm px-3">Mulai Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection