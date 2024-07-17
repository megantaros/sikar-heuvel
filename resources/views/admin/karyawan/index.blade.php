@extends('admin.layouts.base')

@section('title', 'Data Karyawan')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Karyawan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#createKaryawanModal">Create
                            Data Karyawan</button>
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
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Tanggal Lahir</th>
                                    <th>Alamat</th>
                                    <th>Telepon</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($karyawan as $karyawan)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $karyawan->nama_karyawan }}</td>
                                    <td>{{ $karyawan->jabatan }}</td>
                                    <td>{{ $karyawan->tanggal_lahir }}</td>
                                    <td>{{ $karyawan->alamat }}</td>
                                    <td>{{ $karyawan->telepon }}</td>
                                    <td>
                                        <button class="btn btn-secondary mb-2" data-toggle="modal"
                                            data-target="#editKaryawanModal" data-id="{{ $karyawan->id }}"
                                            data-nama="{{ $karyawan->nama_karyawan }}"
                                            data-tanggal_lahir="{{ $karyawan->tanggal_lahir }}"
                                            data-alamat="{{ $karyawan->alamat }}"
                                            data-telepon="{{ $karyawan->telepon }}">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn btn-danger mb-2" data-toggle="modal"
                                            data-target="#deleteKaryawanModal" data-id="{{ $karyawan->id }}"
                                            data-nama="{{ $karyawan->nama_karyawan }}">
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

<!-- Create Karyawan Modal -->
<div class="modal fade" id="createKaryawanModal" tabindex="-1" aria-labelledby="createKaryawanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createKaryawanModalLabel">Create Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('karyawan.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="create_nama_karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="create_nama_karyawan" name="nama_karyawan" required>
                    </div>
                    <div class="form-group">
                        <label for="create_jabatan">Jabatan</label>
                        <select name="jabatan" id="create_jabatan" class="form-control">
                            <option value="" selected disabled>Pilih Jabatan ...</option>
                            <option value="Manager">Manager</option>
                            <option value="Staff">Staff</option>
                            <option value="Karyawan">Karyawan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="create_tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="create_tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="create_alamat">Alamat</label>
                        <textarea class="form-control" id="create_alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="create_telepon">Telepon</label>
                        <input type="text" class="form-control" id="create_telepon" name="telepon" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Karyawan Modal -->
<div class="modal fade" id="editKaryawanModal" tabindex="-1" aria-labelledby="editKaryawanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKaryawanModalLabel">Edit Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editKaryawanForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="edit_nama_karyawan">Nama Karyawan</label>
                        <input type="text" class="form-control" id="edit_nama_karyawan" name="nama_karyawan" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_jabatan">Jabatan</label>
                        <select name="jabatan" id="edit_jabatan" class="form-control">
                            <option value="" selected disabled>Pilih Jabatan ...</option>
                            <option value="Manager">Manager</option>
                            <option value="Staff">Staff</option>
                            <option value="Karyawan">Karyawan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="edit_tanggal_lahir">Tanggal Lahir</label>
                        <input type="date" class="form-control" id="edit_tanggal_lahir" name="tanggal_lahir" required>
                    </div>
                    <div class="form-group">
                        <label for="edit_alamat">Alamat</label>
                        <textarea class="form-control" id="edit_alamat" name="alamat" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="edit_telepon">Telepon</label>
                        <input type="text" class="form-control" id="edit_telepon" name="telepon" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete Karyawan Modal -->
<div class="modal fade" id="deleteKaryawanModal" tabindex="-1" aria-labelledby="deleteKaryawanModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteKaryawanModalLabel">Delete Data Karyawan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete <strong id="delete_nama_karyawan"></strong>?</p>
                <form id="deleteKaryawanForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Delete</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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

    // Edit Karyawan modal
    $('#editKaryawanModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nama = button.data('nama');
        var tanggal_lahir = button.data('tanggal_lahir');
        var alamat = button.data('alamat');
        var telepon = button.data('telepon');

        var modal = $(this);
        modal.find('#edit_nama_karyawan').val(nama);
        modal.find('#edit_tanggal_lahir').val(tanggal_lahir);
        modal.find('#edit_alamat').val(alamat);
        modal.find('#edit_telepon').val(telepon);
        modal.find('form').attr('action', '{{ route("karyawan.update", ":id") }}'.replace(':id', id));
    });

    // Delete Karyawan modal
    $('#deleteKaryawanModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var nama = button.data('nama');

        var modal = $(this);
        modal.find('#delete_nama_karyawan').text(nama);
        modal.find('form').attr('action', '{{ route("karyawan.destroy", ":id") }}'.replace(':id', id));
    });
});
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const teleponInput = document.getElementById('create_telepon');

    teleponInput.addEventListener('input', function(event) {
        // Remove non-digit characters
        teleponInput.value = teleponInput.value.replace(/\D/g, '');
    });

    teleponInput.addEventListener('keypress', function(event) {
        // Only allow digit characters
        if (!/[0-9]/.test(event.key)) {
            event.preventDefault();
        }
    });
});

document.addEventListener("DOMContentLoaded", function() {
    const teleponEditInput = document.getElementById('edit_telepon');

    teleponEditInput.addEventListener('input', function(event) {
        // Remove non-digit characters
        teleponEditInput.value = teleponEditInput.value.replace(/\D/g, '');
    });

    teleponEditInput.addEventListener('keypress', function(event) {
        // Only allow digit characters
        if (!/[0-9]/.test(event.key)) {
            event.preventDefault();
        }
    });
});
</script>
@endsection