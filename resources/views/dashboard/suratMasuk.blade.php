@extends('layouts.app')

@section('title','Dashboard')

@section('content')

<!-- Modal for Add Anggota -->
<div class="modal fade" id="createSuratModal" tabindex="-1" aria-labelledby="createSuratModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Tambah Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('suratMasuk.store') }}" method="POST" enctype="multipart/form-data" class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat:</label>
                        <input type="text" name="nomor_surat" id="nomor_surat" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="pengirim" class="form-label">Pengirim:</label>
                        <input type="text" name="pengirim" id="pengirim" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal:</label>
                        <input type="text" name="perihal" id="perihal" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk:</label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="file_surat" class="form-label">File Surat:</label>
                        <input type="file" name="file_surat" id="file_surat" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="baru">Baru</option>
                            <option value="diproses">Diproses</option>
                            <option value="selesai">Selesai</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Surat</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end modal add-->

@foreach ($suratMasuk as $surat)
<!-- Modal Edit -->
<div class="modal fade" id="editSuratModal{{ $surat->id }}" tabindex="-1"
    aria-labelledby="editSuratLabel{{ $surat->id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSuratLabel{{ $surat->id }}">Edit Surat</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('suratMasuk.update', $surat->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nomor_surat" class="form-label">Nomor Surat</label>
                        <input type="text" class="form-control" name="nomor_surat" value="{{ $surat->nomor_surat }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="pengirim" class="form-label">Pengirim</label>
                        <input type="text" class="form-control" name="pengirim" value="{{ $surat->pengirim }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="perihal" class="form-label">Perihal</label>
                        <input type="text" class="form-control" name="perihal" value="{{ $surat->perihal }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" value="{{ $surat->tanggal_masuk }}"
                            required>
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
                            <option value="baru" {{ $surat->status == 'baru' ? 'selected' : '' }}>Baru</option>
                            <option value="diproses" {{ $surat->status == 'diproses' ? 'selected' : '' }}>Diproses
                            </option>
                            <option value="selesai" {{ $surat->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
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


<div class="container">
    <h2>Daftar Surat Masuk</h2>
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createSuratModal">
        Tambah Data
    </button>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nomor Surat</th>
                <th>Pengirim</th>
                <th>Perihal</th>
                <th>Tanggal Masuk</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($suratMasuk as $index => $surat)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $surat->nomor_surat }}</td>
                <td>{{ $surat->pengirim }}</td>
                <td>{{ $surat->perihal }}</td>
                <td>{{ $surat->tanggal_masuk }}</td>
                <td>
                    @if($surat->status == 'baru')
                    <span class="badge bg-success">Baru</span>
                    @elseif($surat->status == 'diproses')
                    <span class="badge bg-warning">Diproses</span>
                    @else
                    <span class="badge bg-danger">Selesai</span>
                    @endif
                </td>
                <td>
                    <button type="button" class="btn btn-warning " data-bs-toggle="modal"
                        data-bs-target="#editSuratModal{{ $surat->id }}">
                        <i class="fa-solid fa-pen fa-sm"></i>
                    </button>
                    <button type="button" class="btn btn-danger btn-delete-surat" data-id="{{ $surat->id }}">
                        <i class="fa-solid fa-trash fa-sm"></i>
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $suratMasuk->links() }}
</div>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.btn-delete-surat', function(e) {
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
                    url: "/surat-masuk/" + suratId,
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