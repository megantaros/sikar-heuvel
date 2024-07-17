<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Slip Gaji</title>
    <style>
    /* CSS styling untuk slip gaji */
    body {
        font-family: Arial, sans-serif;
        font-size: 14px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 20px;
    }

    th,
    td {
        border: 1px solid #ccc;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }
    </style>
</head>

@php
    function formatRupiah($angka){
        return "Rp " . number_format($angka, 0, ',', '.');
    }
@endphp

<body>
    <h2>Slip Gaji</h2>
    <table>
        <tr>
            <th>Karyawan</th>
            <td>{{ $gaji->karyawan->nama_karyawan }}</td>
        </tr>
        <tr>
            <th>Jabatan</th>
            <td>{{ $gaji->karyawan->jabatan }}</td>
        </tr>
        <tr>
            <th>Tunjangan</th>
            <td>
                @foreach($tunjangan as $tunjangan)
                <div style="display: flex; gap:2px;">
                    {{ $tunjangan->nama_tunjangan }} :
                    {{ formatRupiah($tunjangan->nominal) }}
                </div>
                @endforeach
            </td>
        </tr>
        <tr>
            <th>Total Tunjangan</th>
            <td>{{ formatRupiah($total_tunjangan) }}</td>
        </tr>
        <tr>
            <th>Gaji</th>
            <td>{{ formatRupiah($gaji->gaji) }}</td>
        </tr>
        <tr>
            <th>Total Gaji</th>
            <td>{{ formatRupiah($total_gaji) }}</td>
        </tr>
        <!-- Tambahkan informasi lainnya sesuai kebutuhan -->
    </table>
</body>

</html>