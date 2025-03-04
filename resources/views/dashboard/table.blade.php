@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<!-- Modal for Add Anggota -->
<div class="modal fade" id="createDataModal" tabindex="-1" aria-labelledby="createDataModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createDataModalLabel">Tambah Data Anggota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('anggota.store') }}" method="POST" class="mb-3">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Anggota:</label>
                        <input type="text" name="name" id="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Kontak:</label>
                        <input type="text" name="contact" id="contact" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat:</label>
                        <input type="text" name="address" id="address" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="wilayah_komda" class="form-label">Wilayah Komda:</label>
                        <input type="text" name="wilayah_komda" id="wilayah_komda" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk Anggota:</label>
                        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status:</label>
                        <select name="status" id="status" class="form-control">
                            <option value="Aktif">Aktif</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Tambah Anggota</button>
                </form>
            </div>
        </div>
    </div>
</div>


<!--Main Tables-->
<div class="container-fluid py-2">
    <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createDataModal">
        Tambah Data
    </button>
    <div class="row">
        <div class="col-12">
            <div class="card my-4">
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        No
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Nama
                                    </th>
                                    <th
                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Kontak
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Alamat
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Wilayah Komda
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Tanggal Masuk
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Status
                                    </th>
                                    <th
                                        class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        action
                                    </th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($anggota as $an)
                                <tr>
                                    <td>{{ ($anggota->currentPage() - 1) * $anggota->perPage() + $loop->iteration }}
                                    </td>
                                    <td>{{ $an->name }}</td>
                                    <td>{{ $an->contact }}</td>
                                    <td class="alamat-column">{{ $an->address }}</td>
                                    <td>{{ $an->wilayah_komda }}</td>
                                    <td>{{ $an->tanggal_masuk }}</td>
                                    <td>
                                        @if($an->status == 'Aktif')
                                        <span class="badge bg-success">Aktif</span>
                                        @else
                                        <span class="badge bg-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-warning " data-bs-toggle="modal"
                                            data-bs-target="#editDataModal{{ $an->id }}">
                                            <i class="fa-solid fa-pen fa-sm"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger btn-delete-anggota"
                                            data-id="{{ $an->id }}">
                                            <i class="fa-solid fa-trash fa-sm"></i>
                                        </button>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Menampilkan navigasi halaman -->
<div class="d-flex justify-content-center">
    {{ $anggota->links('pagination::bootstrap-5') }}
</div>
<!---->
@foreach ($anggota as $an)
<!-- Modal Edit -->
<div class="modal fade" id="editDataModal{{ $an->id }}" tabindex="-1" aria-labelledby="editDataLabel{{ $an->id }}"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDataLabel{{ $an->id }}">Edit Data</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('anggota.update', $an->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" class="form-control" name="name" value="{{ $an->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label">Kontak</label>
                        <input type="text" class="form-control" name="contact" value="{{ $an->contact }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Alamat</label>
                        <textarea class="form-control" name="address" required>{{ $an->address }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="wilayah_komda" class="form-label">Wilayah Komda</label>
                        <input type="text" class="form-control" name="wilayah_komda" value="{{ $an->wilayah_komda }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_masuk" class="form-label">Tanggal Masuk</label>
                        <input type="date" class="form-control" name="tanggal_masuk" value="{{ $an->tanggal_masuk }}"
                            required>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="Aktif" {{ $an->status == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="Tidak Aktif" {{ $an->status == 'Tidak Aktif' ? 'selected' : '' }}>Tidak Aktif
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

<!---->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).on('click', '.btn-delete-anggota', function(e) {
        e.preventDefault();
        let anggotaId = $(this).data('id');
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
                    url: "/anggota/" + anggotaId,
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