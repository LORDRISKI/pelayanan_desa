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
        
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <h4 class="fw-bold text-dark mb-0">Data Penduduk</h4>
            
            <div class="d-flex flex-wrap gap-2">
                <a href="#" class="btn btn-success d-flex align-items-center gap-2 px-3 small">
                    <i class="fa-solid fa-print"></i> Cetak Data Penduduk
                </a>
                <a href="{{ route('residents.create') }}" class="btn btn-primary d-flex align-items-center gap-2 px-3 small">
                    <i class="fa-solid fa-circle-plus"></i> Tambah Data
                </a>
                <button type="button" class="btn btn-info text-white d-flex align-items-center gap-2 px-3 small" data-bs-toggle="modal" data-bs-target="#importExcelModal">
                    <i class="fa-solid fa-file-excel"></i> Import Data Excel
                </button>
            </div>
        </div>

        <div class="row g-3 mb-3 align-items-center justify-content-between">
            <div class="col-auto d-flex align-items-center gap-2 small text-muted">
                <span>Tampil</span>
                <select class="form-select form-select-sm" style="width: 75px;">
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
                <span>data</span>
            </div>
            
            <div class="col-auto d-flex align-items-center gap-2 small text-muted">
                <span>Cari Data:</span>
                <input type="text" class="form-control form-control-sm" placeholder="Masukan kata kunci" style="width: 200px;">
            </div>
        </div>

        <div class="table-responsive">
            <table class="table table-striped table-hover align-middle border-top">
                <thead class="table-light text-muted small">
                    <tr>
                        <th width="50">No</th>
                        <th>Nomor KK <i class="fa-solid fa-arrows-up-down text-black-50 ms-1" style="font-size: 10px;"></i></th>
                        <th>NIK <i class="fa-solid fa-arrows-up-down text-black-50 ms-1" style="font-size: 10px;"></i></th>
                        <th>Nama Lengkap <i class="fa-solid fa-arrows-up-down text-black-50 ms-1" style="font-size: 10px;"></i></th>
                        <th>Jenis Kelamin <i class="fa-solid fa-arrows-up-down text-black-50 ms-1" style="font-size: 10px;"></i></th>
                        <th>Tanggal Lahir <i class="fa-solid fa-arrows-up-down text-black-50 ms-1" style="font-size: 10px;"></i></th>
                        <th>Umur</th>
                        <th width="100" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="small text-dark">
                    @forelse($residents as $index => $resident)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $resident->kk_number ?? '-' }}</td>
                        <td>{{ $resident->nik }}</td>
                        <td class="fw-semibold">{{ $resident->name }}</td>
                        <td>
                            @if($resident->gender == 'Laki-laki')
                                <span class="badge bg-primary px-3 py-2 rounded-pill fw-normal" style="font-size: 11px;">Laki-laki</span>
                            @else
                                <span class="badge bg-success px-3 py-2 rounded-pill fw-normal" style="font-size: 11px;">Perempuan</span>
                            @endif
                        </td>
                        <td>{{ $resident->birth_date ? \Carbon\Carbon::parse($resident->birth_date)->format('d/m/Y') : '-' }}</td>
                        <td>{{ $resident->birth_date ? \Carbon\Carbon::parse($resident->birth_date)->age : '-' }}</td>
                        <td class="text-center">
                            <div class="d-flex flex-column align-items-center gap-1">
                                <a href="{{ route('residents.show', $resident->id) }}" class="btn btn-info btn-sm text-white px-2 py-1" style="font-size: 10px;" title="Detail">
                                    <i class="fa-solid fa-file-lines"></i>
                                </a>
                                <a href="{{ route('residents.edit', $resident->id) }}" class="btn btn-warning btn-sm text-white px-2 py-1" style="font-size: 10px;" title="Edit">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('residents.destroy', $resident->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm px-2 py-1" style="font-size: 10px;" title="Hapus">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">Belum ada data penduduk.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="d-flex justify-content-between align-items-center mt-3 small text-muted">
            <div>
                Menampilkan {{ $residents->firstItem() ?? 0 }} sampai {{ $residents->lastItem() ?? 0 }} dari {{ $residents->total() ?? 0 }} data
            </div>
            <div>
                {{ $residents->links() }}
            </div>
        </div>

    </div>
</div>

<div class="modal fade" id="importExcelModal" tabindex="-1" aria-labelledby="importExcelModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('residents.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title fw-bold" id="importExcelModalLabel">Import Data Excel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label class="form-label small fw-bold">Pilih File Excel (.xls, .xlsx)</label>
                        <input type="file" name="file" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary btn-sm">Proses Import</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection