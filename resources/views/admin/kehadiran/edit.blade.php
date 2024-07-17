@extends('admin.layouts.base')

@section('title', 'Edit Data Kehadiran')

@section('content')
<div class="row">
    <div class="col-md-12">

        {{-- Alert Here --}}
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Edit Data Kehadiran</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('kehadiran.update', $kehadiran->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
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

                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button class="btn btn-success">Edit Data</button>
                    <a href="{{ route('kehadiran.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection