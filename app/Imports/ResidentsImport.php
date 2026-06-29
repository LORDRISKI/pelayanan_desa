<?php

namespace App\Imports;

use App\Models\Resident;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ResidentsImport implements ToModel, WithHeadingRow
{
    /**
     * Logika untuk memetakan setiap baris Excel ke database MySQL.
     * WithHeadingRow mendeteksi baris pertama Excel sebagai nama kolom (header).
     */
    public function model(array $row)
    {
        return new Resident([
            'no_kk'          => $row['no_kk'],
            'nik'            => $row['nik'],
            'name'           => $row['nama'],
            'gender'         => $row['jenis_kelamin'], // Isi harus 'L' atau 'P'
            'birth_place'    => $row['tempat_lahir'],
            'birth_date'     => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tanggal_lahir']),
            'marital_status' => $row['status_perkawinan'], // 'Belum Kawin', 'Kawin', dll.
            'religion'       => $row['agama'],
            'profession'     => $row['pekerjaan'],
            'address'        => $row['alamat'],
        ]);
    }
}