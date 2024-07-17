@extends('admin.layouts.base')

@section('title', 'Data Gaji')

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
                <h3 class="card-title">Data Gaji</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#createGajiModal">Create Data
                            Gaji</button>
                    </div>
                </div>
                @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                @endif
                <table class="table table-bordered" id="example1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Karyawan</th>
                            <th>Jabatan</th>
                            <th>Tunjangan</th>
                            <th>Total Tunjangan</th>
                            <th>Gaji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($result as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item['nama'] }}</td>
                            <td>{{ $item['jabatan'] }}</td>
                            <td>
                                @foreach ($item['detail_tunjangan'] as $tun)
                                <div class="d-flex">
                                    {{ $tun['nama_tunjangan'] }}:
                                    {{ formatRupiah($tun['nominal']) }}
                                </div>
                                @endforeach
                            </td>
                            <td>{{ formatRupiah($item['total_tunjangan']) }}</td>
                            <td>{{ formatRupiah($item['gaji']) }}</td>
                            <td>
                                <a href="#" class="btn btn-sm btn-secondary edit-btn" data-id="{{ $item['id'] }}"
                                    data-karyawan="{{ $item['id_karyawan'] }}" data-tunjangan="{{ $item['id_tunjangan'] }}"
                                    data-gaji="{{ $item['gaji'] }}" data-toggle="modal" data-target="#editGajiModal"> <i
                                        class="fas fa-edit"></i></a>
                                <button class="btn btn-sm btn-danger delete-btn" data-id="{{ $item['id'] }}"
                                    data-toggle="modal" data-target="#deleteGajiModal"><i
                                        class="fas fa-trash"></i></button>
                                <a href="{{ route('gaji.print', $item['id']) }}" class="btn btn-sm btn-info"
                                    target="_blank">Print Slip Gaji</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create Gaji Modal -->
<div class="modal fade" id="createGajiModal" tabindex="-1" aria-labelledby="createGajiModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createGajiModalLabel">Create Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('gaji.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="create_karyawan">Nama Karyawan</label>
                        <select class="form-control" id="create_karyawan" name="id_karyawan" required>
                            @foreach($karyawan as $kar)
                            <option value="{{ $kar->id }}">{{ $kar->nama_karyawan }} ({{ $kar->jabatan }})</option>
                            @endforeach
                        </select>
                    </div>
                    {{-- <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select class="form-control" id="jabatan">
                            @foreach ($karyawan as $kar)
                            <option value="{{ $kar->id }}">{{ $kar->jabatan }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="create_tunjangan">Tunjangan</label>
                        <select class="form-control" id="create_tunjangan" name="id_tunjangan">
                            @foreach($tunjangan as $tun)
                            <option value="{{ $tun->id }}">{{ $tun->nama_tunjangan }}</option>
                            @endforeach
                        </select>
                    </div> --}}
                    <div class="form-group">
                        <label for="create_gaji">Gaji</label>
                        <input type="number" class="form-control" id="create_gaji" name="gaji" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Edit Gaji Modal -->
<div class="modal fade" id="editGajiModal" tabindex="-1" role="dialog" aria-labelledby="editGajiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editGajiModalLabel">Edit Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editGajiForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <input type="hidden" name="id" id="edit_id">
                    <div class="form-group">
                        <label for="edit_karyawan">Karyawan</label>
                        <select class="form-control" id="edit_karyawan" name="id_karyawan" required>
                            @foreach($karyawan as $kar)
                            <option value="{{ $kar->id }}">{{ $kar->nama_karyawan }} ({{ $kar->jabatan }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_tunjangan">Tunjangan</label>
                        <select class="form-control" id="edit_tunjangan" name="id_tunjangan">
                            @foreach($tunjangan as $tun)
                            <option value="{{ $tun->id }}">{{ $tun->nama_tunjangan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_gaji">Gaji</label>
                        <input type="number" class="form-control" id="edit_gaji" name="gaji" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Gaji Modal -->
<div class="modal fade" id="deleteGajiModal" tabindex="-1" role="dialog" aria-labelledby="deleteGajiModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteGajiModalLabel">Hapus Data Gaji</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteGajiForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <input type="hidden" name="id" id="delete_id">
                    <p>Apakah Anda yakin ingin menghapus data gaji ini?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
                    <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                </div>
            </form>
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
    // Mengatur data pada modal edit saat tombol edit diklik
    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        var karyawan = $(this).data('karyawan');
        var tunjangan = $(this).data('tunjangan');
        var gaji = $(this).data('gaji');

        $('#edit_id').val(id);
        $('#edit_karyawan').val(karyawan);
        $('#edit_tunjangan').val(tunjangan);
        $('#edit_gaji').val(gaji);

        $('#editGajiForm').attr('action', '{{ route("gaji.update", ":id") }}'.replace(':id', id));
    });

    // Mengatur data pada modal delete saat tombol hapus diklik
    $('.delete-btn').click(function() {
        var id = $(this).data('id');
        $('#delete_id').val(id);
        $('#deleteGajiForm').attr('action', '{{ route("gaji.destroy", ":id") }}'.replace(':id', id));
    });
});
</script>
@endsection