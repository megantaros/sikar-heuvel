@extends('admin.layouts.base')

@section('title', 'Data Hutang Karyawan')

@section('content')
@php
use Carbon\Carbon;
function formatRupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}   
@endphp
<div class="row">
    <div class="col-md-12">
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Data Hutang Karyawan</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <a href="{{ route('hutang.create') }}" class="btn btn-warning">Create Data Hutang Karyawan</a>
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
                                    <th>Nama Karyawan</th>
                                    <th>Total Hutang</th>
                                    <th>Maksimal Hutang</th>
                                    <th>Sisa Hutang</th>
                                    <th>Tanggal Hutang</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($hutangs as $hutang)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ optional($hutang->karyawan)->nama_karyawan }}</td>
                                    <td>{{ formatRupiah($hutang->total_hutang) }}</td>
                                    <td>{{ formatRupiah($hutang->maksimal_hutang) }}</td>
                                    <td>{{ formatRupiah($hutang->sisa_hutang) }}</td>
                                    <td>{{ Carbon::parse($hutang->tanggal_hutang)->format('d-m-Y')  }}</td>
                                    <td>
                                        <form action="{{ route('hutang.destroy', $hutang->id) }}" method="POST">
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