<?php

namespace App\Http\Controllers;


use App\Models\Company;
use App\Models\Services;
use App\Models\Team;
use App\Models\Testimonial;

use function Ramsey\Uuid\v1;

class UserController extends Controller
{
    public function index()
    {
        $namaCompany = Company::pluck('nama_perusahaan');
        $alamatCompany = Company::pluck('alamat_perusahaan');
        $phoneCompany = Company::pluck('no_hp_perusahaan');
        $emailCompany = Company::pluck('email_perusahaan');
        $visiCompany = Company::pluck('visi_perusahaan');
        $misiCompany = Company::pluck('misi_perusahaan');
        $rencanaCompany = Company::pluck('rencana_perusahaan');
        $tentangCompany = Company::pluck('tentang_perusahaan');
        $services = Services::all();
        $teams = Team::all();
        $testimonis = Testimonial::all();

        return view('index', [
            'namaCompany' => $namaCompany,
            'alamatCompany' => $alamatCompany,
            'phoneCompany' => $phoneCompany,
            'emailCompany' => $emailCompany,
            'visiCompany' => $visiCompany,
            'misiCompany' => $misiCompany,
            'rencanaCompany' => $rencanaCompany,
            'tentangCompany' => $tentangCompany,
            'services' => $services,
            'teams' => $teams,
            'testimonis' => $testimonis,
        ]);
        
    }

}
