@extends('admin.layouts.base')

@section('title', 'Data Angsuran Hutang Karyawan')

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
                <h3 class="card-title">Data Angsuran Hutang Karyawan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <a href="{{ route('angsuran.create') }}" class="btn btn-warning">Create Data Hutang Karyawan</a>
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
                                    <th>Nama Penghutang</th>
                                    <th>Total Hutang</th>
                                    <th>Sisa Hutang</th>
                                    <th>Angsuran Pertama</th>
                                    <th>Tanggal Angsuran Pertama</th>
                                    <th>Angsuran Kedua</th>
                                    <th>Tanggal Angsuran Kedua</th>
                                    <th>Angsuran Ketiga</th>
                                    <th>Tanggal Angsuran Ketiga</th>
                                    <th>Angsuran Keempat</th>
                                    <th>Tanggal Angsuran Keempat</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($angsurans as $angsuran)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $angsuran->hutang->karyawan->nama_karyawan }}</td>
                                    <td>{{ formatRupiah($angsuran->hutang->total_hutang) }}</td>
                                    <td>{{ formatRupiah($angsuran->hutang->sisa_hutang) }}</td>
                                    <td>{{ formatRupiah($angsuran->angsuran_pertama) }}</td>
                                    <td>{{ $angsuran->tanggal_angsuran_pertama }}</td>
                                    <td>{{ formatRupiah($angsuran->angsuran_kedua) }}</td>
                                    <td>{{ $angsuran->tanggal_angsuran_kedua }}</td>
                                    <td>{{ formatRupiah($angsuran->angsuran_ketiga) }}</td>
                                    <td>{{ $angsuran->tanggal_angsuran_ketiga }}</td>
                                    <td>{{ formatRupiah($angsuran->angsuran_keempat) }}</td>
                                    <td>{{ $angsuran->tanggal_angsuran_keempat }}</td>
                                    <td>
                                        <a href="{{ route('angsuran.edit', $angsuran->id) }}"
                                            class="btn btn-secondary mb-2"><i class="fas fa-edit"></i></a>
                                        <form action="{{ route('angsuran.destroy', $angsuran->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                class="btn btn-danger mb-2"> <i class="fas fa-trash"></i></button>
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
@endsection

@section('js')
<script>
$('#example1').DataTable({
    "responsive": true,
    "lengthChange": false,
    "autoWidth": false,
    "buttons": ["excel", "pdf", "print"]
}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
</script>
@endsection