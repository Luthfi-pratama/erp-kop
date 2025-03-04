@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<!-- Modal for Add Surat Keluar -->
<div class="modal fade" id="createSuratModal" tabindex="-1" aria-labelledby="createSuratModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Tambah Surat Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suratKeluar.store') }}" method="POST" enctype="multipart/form-data"
                    class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat:</label>
                        <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan:</label>
                        <input type="text" name="tujuan" id="tujuan" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal:</label>
                        <input type="text" name="perihal" id="perihal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_keluar" class="form-label">Tanggal Keluar:</label>
                        <input type="date" name="tanggal_keluar" id="tanggal_keluar" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="file_surat" class="form-label">File Surat (Opsional):</label>
                        <input type="file" name="file_surat" id="file_surat" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="draft">Draft</option>
                            <option value="dikirim">Dikirim</option>
                            <option value="diterima">Diterima</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Surat</button>
                </form>
            </div>
        </div>
    </div>
</div>

@foreach ($suratKeluar as $surat)
<!-- Modal Edit Surat Keluar -->
<div class="modal fade" id="editSuratModal{{ $surat->id }}" tabindex="-1"
    aria-labelledby="editSuratLabel{{ $surat->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSuratLabel{{ $surat->id }}">Edit Surat Keluar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('suratKeluar.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" name="nomor_surat" value="{{ $surat->nomor_surat }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="tujuan" class="form-label">Tujuan</label>
                        <input type="text" class="form-control" name="tujuan" value="{{ $surat->tujuan }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal</label>
                        <input type="text" class="form-control" name="perihal" value="{{ $surat->perihal }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_keluar" class="form-label">Tanggal Keluar</label>
                        <input type="date" class="form-control" name="tanggal_keluar"
                            value="{{ $surat->tanggal_keluar }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="file_surat" class="form-label">File Surat</label>
                        <input type="file" class="form-control" name="file_surat">
                        @if ($surat->file_surat)
                        <p class="mt-2"><a href="{{ asset('storage/' . $surat->file_surat) }}" target="_blank">Lihat
                                File</a></p>
                        @endif
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="draft" {{ $surat->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="dikirim" {{ $surat->status == 'dikirim' ? 'selected' : '' }}>Dikirim</option>
                            <option value="diterima" {{ $surat->status == 'diterima' ? 'selected' : '' }}>Diterima
                            </option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach



<!--table-->
<div class="container">
    <h2>Daftar Surat Keluar</h2>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSuratModal">
        Tambah Data
    </button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Tujuan</th>
                <th>Perihal</th>
                <th>Tanggal Keluar</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suratKeluar as $index => $surat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $surat->nomor_surat }}</td>
                <td>{{ $surat->tujuan }}</td>
                <td>{{ $surat->perihal }}</td>
                <td>{{ $surat->tanggal_keluar }}</td>
                <td>
                    @if($surat->status == 'draft')
                    <span class="badge bg-secondary">Draft</span>
                    @elseif($surat->status == 'dikirim')
                    <span class="badge bg-warning">Dikirim</span>
                    @else
                    <span class="badge bg-success">Diterima</span>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                        data-bs-target="#editSuratModal{{ $surat->id }}">
                        <i class="fa-solid fa-pen fa-sm"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-delete-suratkeluar" data-id="{{ $surat->id }}">
                        <i class="fa-solid fa-trash fa-sm"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $suratKeluar->links() }}
</div>

<!--end table-->


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.btn-delete-suratkeluar', function(e) {
        e.preventDefault();
        let suratId = $(this).data('id');
        let token = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: "Apakah Anda yakin?",
            text: "Data ini akan dihapus secara permanen!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#d33",
            cancelButtonColor: "#3085d6",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Batal"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/surat-keluar/" + suratId,
                    type: "DELETE",
                    data: {
                        "_token": token
                    },
                    success: function(response) {
                        Swal.fire({
                            title: "Terhapus!",
                            text: response.message,
                            icon: "success"
                        }).then(() => {
                            location.reload(); // Refresh halaman setelah delete
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: "Gagal!",
                            text: "Terjadi kesalahan, coba lagi.",
                            icon: "error"
                        });
                    }
                });
            }
        });
    });
</script>
@endsection