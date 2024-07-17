@extends('admin.layouts.base')

@section('title', 'Data Kehadiran')

@section('content')
@php
use Carbon\Carbon;
@endphp

<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Kehadiran</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <button class="btn btn-warning" data-toggle="modal" data-target="#createKehadiranModal">Tambah
                            Data Kehadiran</button>
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
                                    <th>Tanggal Kehadiran</th>
                                    <th>Status Kehadiran</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($kehadiran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->karyawan->nama_karyawan }}</td>
                                    <td>{{ Carbon::parse($item->tanggal)->format('d-m-Y') }}
                                        <div class="text-success"><i class="fas fa-plus "></i> {{ $item->jam_hadir }}
                                        </div>
                                        <div class="text-danger"><i class="fas fa-minus "></i> {{ $item->jam_pulang }}
                                        </div>
                                    </td>
                                    <td>
                                        @if ($item->status_kehadiran == 'Tepat Waktu')
                                        <button class="btn btn-success">{{ $item->status_kehadiran }}</button>
                                        @elseif ($item->status_kehadiran == 'Terlambat')
                                        <button class="btn btn-danger">{{ $item->status_kehadiran }}</button>
                                        @else
                                        <button class="btn btn-secondary">{{ $item->status_kehadiran }}</button>
                                        @endif
                                    </td>

                                    <td>
                                        <a href="{{ route('kehadiran.edit', $item->id) }}"
                                            class="btn btn-secondary mb-2"><i class="fas fa-edit"></i></a>
                                        <form method="post" action="{{ route('kehadiran.destroy', $item->id) }}">
                                            @method('delete')
                                            @csrf
                                            <button type="submit" class="btn btn-danger">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
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

<!-- Create Kehadiran Modal -->
<div class="modal fade" id="createKehadiranModal" tabindex="-1" aria-labelledby="createKehadiranModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createKehadiranModalLabel">Tambah Data Kehadiran</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('kehadiran.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="id_karyawan">Karyawan</label>
                        <select class="form-control" id="id_karyawan" name="id_karyawan" required>
                            @foreach($karyawan as $item)
                            <option value="{{ $item->id }}">{{ $item->nama_karyawan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jabatan">Jabatan</label>
                        <select class="form-control" id="jabatan">
                            @foreach ($karyawan as $item)
                            <option value="{{ $item->id }}">{{ $item->jabatan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="jam_hadir">Jam Hadir</label>
                        <input type="time" class="form-control" id="jam_hadir" name="jam_hadir" required>
                    </div>
                    <div class="form-group">
                        <label for="jam_pulang">Jam Pulang</label>
                        <input type="time" class="form-control" id="jam_pulang" name="jam_pulang" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" class="form-control" id="tanggal" name="tanggal" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status Kehadiran</label>
                        <select class="form-control" id="status" name="status_kehadiran" required>
                            <option value="" selected disabled>Pilih Status ...</option>
                            <option value="Tepat Waktu">Tepat Waktu</option>
                            <option value="Terlambat">Terlambat</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
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
});
</script>
@endsection