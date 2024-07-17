@extends('admin.layouts.base')

@section('title', 'Data Tunjangan')

@section('content')
@php
    function formatRupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
    }
@endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Data Tunjangan</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <button class="btn btn-warning" data-toggle="modal" data-target="#createTunjanganModal">Tambah Data Tunjangan</button>
                        </div>
                    </div>

                    @if (session()->has('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <table id="example1" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Karyawan</th>
                                        <th>Gaji</th>
                                        <th>Nama Tunjangan</th>
                                        <th>Nominal</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($tunjangan as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->karyawan->nama_karyawan }}</td>
                                            <td>{{ formatRupiah($item->gaji->gaji) ?? 0 }}</td>
                                            <td>{{ $item->nama_tunjangan }}</td>
                                            <td>{{ formatRupiah($item->nominal) ?? 0 }}</td>
                                            <td>
                                                <button class="btn btn-secondary mb-2 edit-btn"
                                                        data-id="{{ $item->id }}"
                                                        data-id_karyawan="{{ $item->id_karyawan }}"
                                                        data-id_gaji="{{ $item->id_gaji }}"
                                                        data-nama_tunjangan="{{ $item->nama_tunjangan }}"
                                                        data-nominal="{{ $item->nominal }}"
                                                        data-toggle="modal"
                                                        data-target="#editTunjanganModal">
                                                        <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-danger mb-2 delete-btn"
                                                        data-id="{{ $item->id }}"
                                                        data-nama="{{ $item->karyawan->nama_karyawan }}"
                                                        data-toggle="modal"
                                                        data-target="#deleteTunjanganModal"
                                                        >
                                                        <i class="fas fa-trash"></i>
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

    <!-- Create Tunjangan Modal -->
    <div class="modal fade" id="createTunjanganModal" tabindex="-1" aria-labelledby="createTunjanganModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTunjanganModalLabel">Tambah Data Tunjangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('tunjangan.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="id_karyawan">Karyawan</label>
                            <select class="form-control" id="id_karyawan" name="id_karyawan" required>
                                @foreach($karyawan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_karyawan }} ({{ $item->jabatan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="id_gaji">Gaji</label>
                            <select class="form-control" id="id_gaji" name="id_gaji" required>
                                @foreach($gaji as $item)
                                    <option value="{{ $item->id }}">{{ formatRupiah($item->gaji) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="nama_tunjangan">Nama Tunjangan</label>
                            <input type="text" class="form-control" id="nama_tunjangan" name="nama_tunjangan" required>
                        </div>
                        <div class="form-group">
                            <label for="nominal">Nominal</label>
                            <input type="number" class="form-control" id="nominal" name="nominal" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Tunjangan Modal -->
    <div class="modal fade" id="editTunjanganModal" tabindex="-1" aria-labelledby="editTunjanganModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTunjanganModalLabel">Edit Data Tunjangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="edit_id_karyawan">Karyawan</label>
                            <select class="form-control" id="edit_id_karyawan" name="id_karyawan" required>
                                @foreach($karyawan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_karyawan }} ({{ $item->jabatan }})</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_id_gaji">Gaji</label>
                            <select class="form-control" id="edit_id_gaji" name="id_gaji" required>
                                @foreach($gaji as $item)
                                    <option value="{{ $item->id }}">{{ formatRupiah($item->gaji) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="edit_nama_tunjangan">Nama Tunjangan</label>
                            <input type="text" class="form-control" id="edit_nama_tunjangan" name="nama_tunjangan" required>
                        </div>
                        <div class="form-group">
                            <label for="edit_nominal">Nominal</label>
                            <input type="number" class="form-control" id="edit_nominal" name="nominal" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Tunjangan Modal -->
    <div class="modal fade" id="deleteTunjanganModal" tabindex="-1" aria-labelledby="deleteTunjanganModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteTunjanganModalLabel">Hapus Data Tunjangan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus data tunjangan untuk <strong id="delete_nama_karyawan"></strong>?</p>
                    <form id="deleteTunjanganForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-danger">Hapus</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#example1').DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            $('.edit-btn').on('click', function() {
                var id = $(this).data('id');
                var id_karyawan = $(this).data('id_karyawan');
                var id_gaji = $(this).data('id_gaji');
                var nama_tunjangan = $(this).data('nama_tunjangan');
                var nominal = $(this).data('nominal');

                $('#edit_id_karyawan').val(id_karyawan);
                $('#edit_id_gaji').val(id_gaji);
                $('#edit_nama_tunjangan').val(nama_tunjangan);
                $('#edit_nominal').val(nominal);

                $('#editForm').attr('action', '{{ route("tunjangan.update", ":id") }}'.replace(':id', id));
            });

            $('.delete-btn').on('click', function() {
                var id = $(this).data('id');
                var nama = $(this).data('nama');

                $('#delete_nama_karyawan').text(nama);
                $('#deleteTunjanganForm').attr('action', '{{ route("tunjangan.destroy", ":id") }}'.replace(':id', id));
            });
        });
    </script>
@endsection
