@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white py-3">
            <h5 class="mb-0 font-weight-bold">Form Input Cetak Surat</h5>
        </div>
        <div class="card-body p-4">
            <form action="{{ route('letters.store') }}" method="POST">
                @csrf
                
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Nomor Surat</label>
                        <input type="text" name="letter_number" class="form-control @error('letter_number') is-invalid @enderror" placeholder="Contoh: 140/02/SKD/2026" value="{{ old('letter_number') }}" required>
                        @error('letter_number') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Jenis Surat Keluar</label>
                        <select name="letter_type" class="form-select" required>
                            <option value="SKD">Surat Keterangan Domisili (SKD)</option>
                            <option value="SKU">Surat Keterangan Usaha (SKU)</option>
                            <option value="SKTM">Surat Keterangan Tidak Mampu (SKTM)</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label font-weight-bold">Pilih Pemohon (Warga)</label>
                    <select name="resident_id" class="form-select @error('resident_id') is-invalid @enderror" required>
                        <option value="">-- Cari NIK / Nama Penduduk --</option>
                        @foreach($residents as $resident)
                            <option value="{{ $resident->id }}">{{ $resident->nik }} - {{ $resident->name }}</option>
                        @endforeach
                    </select>
                    @error('resident_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    <small class="text-muted">Jika nama warga tidak muncul, pastikan Anda sudah mengisi data warga terlebih dahulu di menu "Data Penduduk".</small>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label font-weight-bold">Tanggal Surat</label>
                        <input type="date" name="letter_date" class="form-control" value="{{ date('Y-m-d') }}" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label font-weight-bold">Keperluan / Alasan Pembuatan</label>
                    <textarea name="purpose" class="form-control" rows="3" placeholder="Contoh: Persyaratan pengajuan KUR Bank / Pindah domisili ke Jambi" required>{{ old('purpose') }}</textarea>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('letters.index') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">Simpan Arsip Surat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection