<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RequestPerizinanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('request_perizinan')->insert([
            [
                'tanggal_request' => '2022-01-01',
                'status_request' => 'Menunggu Persetujuan',
                'keterangan' => 'Saya memerlukan surat keterangan domisili untuk keperluan administrasi',
                'jenis_id' => 1,
                'warga_id' => 1
            ],
            [
                'tanggal_request' => '2022-02-02',
                'status_request' => 'Disetujui',
                'keterangan' => 'Saya memerlukan surat keterangan usaha untuk keperluan perpanjangan izin usaha',
                'jenis_id' => 2,
                'warga_id' => 2
            ],
            [
                'tanggal_request' => '2022-03-03',
                'status_request' => 'Ditolak',
                'keterangan' => 'Saya memerlukan surat keterangan belum menikah untuk keperluan beasiswa',
                'jenis_id' => 3,
                'warga_id' => 3
            ]
        ]);
    }
}
