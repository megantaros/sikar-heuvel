@extends('admin.layouts.base')

@section('title', 'Tambah Data Angsuran Hutang Karyawan')

@section('content')

@php
    function formatRupiah($angka){
        $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
        return $hasil_rupiah;
    }
@endphp

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

        @session('error')
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
        @endsession

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Create Data Angsuran Hutang Karyawan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('angsuran.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="hutang_id">Nama Karyawan</label>
                        <select name="hutang_id" id="hutang_id" required class="form-control">
                            @foreach ($hutangs as $hutang)
                            <option value="{{ $hutang->id }}">{{ $hutang->karyawan->nama_karyawan }} ({{ formatRupiah($hutang->sisa_hutang) }})</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="angsuran_pertama">Angsuran Pertama:</label>
                        <input type="number" name="angsuran_pertama" id="angsuran_pertama" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_angsuran_pertama">Tanggal Angsuran Pertama:</label>
                        <input type="date" name="tanggal_angsuran_pertama" id="tanggal_angsuran_pertama"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="angsuran_kedua">Angsuran Kedua:</label>
                        <input type="number" name="angsuran_kedua" id="angsuran_kedua" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_angsuran_kedua">Tanggal Angsuran Kedua:</label>
                        <input type="date" name="tanggal_angsuran_kedua" id="tanggal_angsuran_kedua"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="angsuran_ketiga">Angsuran Ketiga:</label>
                        <input type="number" name="angsuran_ketiga" id="angsuran_ketiga" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_angsuran_ketiga">Tanggal Angsuran Ketiga:</label>
                        <input type="date" name="tanggal_angsuran_ketiga" id="tanggal_angsuran_ketiga"
                            class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="angsuran_keempat">Angsuran Keempat:</label>
                        <input type="number" name="angsuran_keempat" id="angsuran_keempat" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="tanggal_angsuran_keempat">Tanggal Angsuran Keempat:</label>
                        <input type="date" name="tanggal_angsuran_keempat" id="tanggal_angsuran_keempat"
                            class="form-control">
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button class="btn btn-success">Tambah Data</button>
                    <a href="{{ route('angsuran.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection