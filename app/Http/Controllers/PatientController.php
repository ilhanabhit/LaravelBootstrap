<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function store()
    {
        Patient::create([
            'NIK' => '1234567890',
            'nama' => 'John Doe',
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelasmin' => 'Kelas A',
            'no_bpjs' => '123456789',
            'email' => 'john.doe@example.com',
        ]);

        return response()->json(['message' => 'Patient created successfully']);
    }
}
