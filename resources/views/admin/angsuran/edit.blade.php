@extends('admin.layouts.base')

@section('title', 'Edit Data Angsuran Hutang Karyawan')

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
                <h3 class="card-title">Edit Data Angsuran Hutang Karyawan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('angsuran.update', $angsuran->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="hutang_id">Nama Karyawan</label>
                        <select name="hutang_id" id="hutang_id" required class="form-control">
                            @foreach ($hutangs as $hutang)
                            <option value="{{ $hutang->id }}"
                                {{ $angsuran->hutang_id == $hutang->id ? 'selected' : '' }}>
                                {{ $hutang->karyawan->nama_karyawan }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="angsuran_pertama">Angsuran Pertama:</label>
                        <input type="number" name="angsuran_pertama" id="angsuran_pertama"
                            value="{{ $angsuran->angsuran_pertama }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_angsuran_pertama">Tanggal Angsuran Pertama:</label>
                        <input type="date" name="tanggal_angsuran_pertama" id="tanggal_angsuran_pertama"
                            value="{{ $angsuran->tanggal_angsuran_pertama }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="angsuran_kedua">Angsuran Kedua:</label>
                        <input type="number" name="angsuran_kedua" id="angsuran_kedua"
                            value="{{ $angsuran->angsuran_kedua }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_angsuran_kedua">Tanggal Angsuran Kedua:</label>
                        <input type="date" name="tanggal_angsuran_kedua" id="tanggal_angsuran_kedua"
                            value="{{ $angsuran->tanggal_angsuran_kedua }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="angsuran_ketiga">Angsuran Ketiga:</label>
                        <input type="number" name="angsuran_ketiga" id="angsuran_ketiga"
                            value="{{ $angsuran->angsuran_ketiga }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_angsuran_ketiga">Tanggal Angsuran Ketiga:</label>
                        <input type="date" name="tanggal_angsuran_ketiga" id="tanggal_angsuran_ketiga"
                            value="{{ $angsuran->tanggal_angsuran_ketiga }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="angsuran_keempat">Angsuran Keempat:</label>
                        <input type="number" name="angsuran_keempat" id="angsuran_keempat"
                            value="{{ $angsuran->angsuran_keempat }}" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_angsuran_keempat">Tanggal Angsuran Keempat:</label>
                        <input type="date" name="tanggal_angsuran_keempat" id="tanggal_angsuran_keempat"
                            value="{{ $angsuran->tanggal_angsuran_keempat }}" class="form-control">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button class="btn btn-success">Edit Data</button>
                    <a href="{{ route('angsuran.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection