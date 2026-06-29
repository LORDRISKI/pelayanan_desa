@extends('layouts.app')

@section('content')
<div class="container-fluid mt-4">
    <div class="card border-0 shadow-sm p-4 bg-white" style="max-width: 600px;">
        <h5 class="fw-bold text-dark mb-4">Ubah Data Penduduk</h5>

        <form action="{{ route('residents.update', $resident->id) }}" method="POST">
            @csrf
            @method('PUT') <div class="mb-3">
                <label class="form-label small fw-bold">Nomor KK</label>
                <input type="text" name="kk_number" class="form-control" value="{{ old('kk_number', $resident->kk_number) }}">
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">NIK</label>
                <input type="text" name="nik" class="form-control" value="{{ old('nik', $resident->nik) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $resident->name) }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Jenis Kelamin</label>
                <select name="gender" class="form-select @error('gender') is-invalid @enderror" required>
                    <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('gender', $resident->gender ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('gender', $resident->gender ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label small fw-bold">Tanggal Lahir</label>
                <input type="date" name="birth_date" class="form-control" value="{{ old('birth_date', $resident->birth_date) }}" required>
            </div>

            <div class="d-flex gap-2 pt-2">
                <a href="{{ route('residents.index') }}" class="btn btn-secondary btn-sm px-3">Batal</a>
                <button type="submit" class="btn btn-primary btn-sm px-3">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>
@endsection