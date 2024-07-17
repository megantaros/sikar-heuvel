@extends('admin.layouts.base')

@section('title', 'Tambah Data Hutang Karyawan')

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
                <h3 class="card-title">Create Data Hutang Karyawan</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form enctype="multipart/form-data" method="POST" action="{{ route('hutang.store') }}">
                @csrf
                <div class="card-body">
                    <div class="form-group">
                        <label for="id_karyawan">Nama Karyawan</label>
                        <select class="form-control" id="id_karyawan" name="id_karyawan" required>
                            <option value="">Pilih Karyawan</option>
                            @foreach ($karyawans as $karyawan)
                            <option value="{{ $karyawan->id }}">{{ $karyawan->nama_karyawan }} ({{ $karyawan->jabatan }})</option>
                            @endforeach
                        </select>
                        <p id="maxDebt" class="text-danger"></p>
                    </div>
                    <div class="form-group">
                        <label for="total_hutang">Total Hutang</label>
                        <input type="number" class="form-control" id="total_hutang" name="total_hutang" required>
                    </div>
                    <input type="hidden" name="maksimal_hutang" id="maksimal_hutang">
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button class="btn btn-success">Tambah Data</button>
                    <a href="{{ route('hutang.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function () {
        const $selectKaryawan = $('#id_karyawan');
        const $url_show_employee = "{{ route('ajaxShowEmployee', '') }}";

        function formatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, ''),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        $selectKaryawan.change(function () {
            const idKaryawan = $(this).val();
            $.ajax({
                url: `${$url_show_employee}/${idKaryawan}`,
                method: 'GET',
                success: function (response) {
                    console.log(response.data.jabatan);
                    let maxDebt = 0;
                    if (response.data.jabatan === 'Manager') {
                        maxDebt = 1500000;
                    } else if (response.data.jabatan === 'Staff') {
                        maxDebt = 1000000;
                    } else {
                        maxDebt = 500000;
                    }

                    $('#maxDebt').text(`Maksimal Hutang: Rp.${formatRupiah(maxDebt)}`);
                    $('#total_hutang').attr('max', maxDebt);
                    $('#maksimal_hutang').val(maxDebt);
                }
            });
        });

        $('#total_hutang').keyup(function () {
            const totalHutang = $(this).val();
            const maxDebt = $('#total_hutang').attr('max');
            if (parseInt(totalHutang) > parseInt(maxDebt)) {
                $(this).val(maxDebt);
            }
        });
    });
</script>
@endsection