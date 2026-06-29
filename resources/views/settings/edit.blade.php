@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="mb-0 font-weight-bold">Pengaturan Sistem & Kop Surat Desa</h5>
        </div>
        <div class="card-body p-4">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('settings.update', $setting->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Nama Desa</label>
                        <input type="text" name="village_name" class="form-control" value="{{ $setting->village_name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Kecamatan</label>
                        <input type="text" name="district_name" class="form-control" value="{{ $setting->district_name }}" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Kabupaten</label>
                        <input type="text" name="regency_name" class="form-control" value="{{ $setting->regency_name }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Logo Resmi Desa</label>
                        <input type="file" name="letter_header_logo" class="form-control">
                        @if($setting->letter_header_logo)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $setting->letter_header_logo) }}" alt="Logo Desa" style="max-height: 80px;">
                            </div>
                        @endif
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label font-weight-bold">Alamat Lengkap Kantor Desa</label>
                    <textarea name="village_address" class="form-control" rows="3" required>{{ $setting->village_address }}</textarea>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 fw-bold">Simpan Perubahan Pengaturan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection